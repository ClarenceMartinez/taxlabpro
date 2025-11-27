<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Firebase\JWT\JWT;
use Carbon\CarbonImmutable; // Use immutable for safety
use Exception;

class A2AService
{
    private array $config;
    private string $privateKey;
    private string $privateKeyTest;

    public function __construct()
    {
        $this->config = config('services.irs_a2a');
        //$this->privateKey = file_get_contents($this->config['private_key_path']);
        //$this->privateKeyTest = file_get_contents($this->config['private_key_path_test']);
    }

    /**
     * Get a valid access token, either from cache or by requesting a new one.
     */
    public function getAccessToken(): ?string
    {
        $cacheKey = $this->config['token_cache_key'];

        // Try cache first
        $token = Cache::get($cacheKey);
        if ($token) {
            return $token;
        }

        // If not cached, request a new token
        Log::info('IRS A2A: Requesting new access token.');
        $response = $this->requestNewAccessToken();

        if ($response && isset($response['access_token'])) {
            $expiresIn = $response['expires_in'] ?? 900; // Default 15 mins from Pub 5718
            $ttl = max(1, $expiresIn - $this->config['token_cache_ttl_safety_margin']); // Apply safety margin

            Cache::put($cacheKey, $response['access_token'], $ttl);
            Log::info('IRS A2A: New access token obtained and cached.', ['ttl' => $ttl]);
            return $response['access_token'];
        }

        Log::error('IRS A2A: Failed to obtain access token.');
        return null;
    }

    /**
     * Force request a new access token from the IRS Token Endpoint.
     */
    private function requestNewAccessToken(): ?array
    {
        try {
            $clientJwt = $this->generateClientJwt();
            $userJwt = $this->generateUserJwt();

            $response = Http::asForm()->post($this->config['token_url'], [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $userJwt,
                'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
                'client_assertion' => $clientJwt,
            ]);

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('IRS A2A: Token request failed.', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'url' => $this->config['token_url']
                ]);
                return null;
            }
        } catch (Exception $e) {
            Log::error('IRS A2A: Exception during token request.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString() // Be careful logging full trace in prod
            ]);
            return null;
        }
    }

    /**
     * Generate the Client JWT (authenticates your application).
     * Ref: Pub 5718, Section 3.1.3, Page 24 Payload claims
     */
    private function generateClientJwt(): string
    {
        $now = CarbonImmutable::now();
        $payload = [
            'iss' => $this->config['client_id'],          // Issuer: Your Client ID
            'sub' => $this->config['client_id'],          // Subject: Your Client ID
            'aud' => $this->config['audience'],           // Audience: IRS Token Endpoint
            'exp' => $now->addMinutes(15)->timestamp,     // Expiration: 15 mins (as per Pub 5718)
            'iat' => $now->timestamp,                     // Issued At
            'jti' => (string) Str::uuid(),                // JWT ID: Unique identifier
        ];
        $headers = [
            'kid' => $this->config['private_key_id'],     // Key ID
            'alg' => 'RS256'                              // Algorithm (Must be RS256)
        ];

        return JWT::encode($payload, $this->privateKey, 'RS256', null, $headers);
    }

    /**
     * Generate the User JWT (represents the authorization grant).
     * Ref: Pub 5718, Section 3.1.3, Page 24 Payload claims
     */
    private function generateUserJwt(): string
    {
        $now = CarbonImmutable::now();
        $payload = [
            'iss' => $this->config['client_id'],          // Issuer: Your Client ID
            'sub' => $this->config['user_id'],            // Subject: The IRIS UserID (from Consent App)
            'aud' => $this->config['audience'],           // Audience: IRS Token Endpoint
            'exp' => $now->addMinutes(15)->timestamp,     // Expiration: 15 mins
            'iat' => $now->timestamp,                     // Issued At
            'jti' => (string) Str::uuid(),                // JWT ID: Unique identifier
        ];
         $headers = [
            'kid' => $this->config['private_key_id'],     // Key ID
            'alg' => 'RS256'                              // Algorithm
        ];

        return JWT::encode($payload, $this->privateKey, 'RS256', null, $headers);
    }

    /**
     * Make an authenticated API call to an IRS resource.
     * Example for submitting returns (POST with XML)
     * Ref: Pub 5718, Section 3.1.4, Table 3-3
     */
    public function submitInformationReturn(string $xmlPayload): ?array
    {
        $token = $this->getAccessToken();
        if (!$token) {
            Log::error('IRS A2A: Cannot make API call without access token.');
            return null; // Or throw exception
        }

        $endpoint = $this->config['api_base_url'] . '/intake-acceptance'; // Example endpoint

        try {
            // Pub 5718 specifies multipart/form-data for submission
            // The XML is sent as a file attachment part.
            $response = Http::withToken($token)
                ->attach(
                    'file',          // Field name expected by IRS API (check Fig 3-5)
                    $xmlPayload,     // The XML content
                    'submission.xml' // A filename for the attachment part
                )
                //->contentType('multipart/form-data') // Guzzle usually handles this with attach
                ->accept('application/xml') // Expected response type
                ->post($endpoint);

            if ($response->successful()) {
                // Successful submission likely returns XML with ReceiptID (Fig 3-6)
                // Parse the XML response here. SimpleXML or DOMDocument can be used.
                 Log::info('IRS A2A: Submission successful.', ['status' => $response->status(), 'endpoint' => $endpoint]);
                 // Example parsing (adjust based on actual XML structure)
                 try {
                     $xmlObject = simplexml_load_string($response->body());
                     if ($xmlObject !== false && isset($xmlObject->receiptId)) {
                         return ['receiptId' => (string)$xmlObject->receiptId];
                     }
                 } catch(Exception $parseEx) {
                     Log::warning('IRS A2A: Failed to parse successful XML response.', ['body' => $response->body()]);
                 }
                 // Return raw body or generic success if parsing fails/not needed
                 return ['status' => $response->status(), 'body' => $response->body()];

            } else {
                 Log::error('IRS A2A: API call failed.', [
                    'status' => $response->status(),
                    'body' => $response->body(), // Might be XML or JSON error details
                    'endpoint' => $endpoint
                ]);
                // Attempt to parse error response (could be XML or other format)
                return ['error' => true, 'status' => $response->status(), 'body' => $response->body()];
            }
        } catch (Exception $e) {
            Log::error('IRS A2A: Exception during API call.', [
                 'message' => $e->getMessage(),
                 'endpoint' => $endpoint,
                 'trace' => $e->getTraceAsString() // Careful in prod
            ]);
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }

     /**
     * Make an authenticated API call to get status/acknowledgement.
     * Example for GetStatus/Ack (POST with XML body)
     * Ref: Pub 5718, Section 3.1.4, Table 3-4
     */
    public function getTransmissionStatus(string $receiptIdOrUtid, string $searchType = 'RID', string $transmitterTcc): ?string // Returns raw XML response
    {
        $token = $this->getAccessToken();
        if (!$token) {
            Log::error('IRS A2A: Cannot get status without access token.');
            return null; // Or throw exception
        }

        $endpoint = $this->config['api_base_url'] . '/transstatusorack'; // Example endpoint

        // Construct the XML request payload per Figure 3-9
        $xmlRequest = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<transstatusOrAckRequest>
    <searchId>{$receiptIdOrUtid}</searchId>
    <searchParameterTypeCd>{$searchType}</searchParameterTypeCd>
    <searchTypeCd>A</searchTypeCd>
    <transmitterControlCd>{$transmitterTcc}</transmitterControlCd>
</transstatusOrAckRequest>
XML;

        try {
            $response = Http::withToken($token)
                ->withBody($xmlRequest, 'application/xml')
                ->accept('application/xml') // Expected response type
                ->post($endpoint);

            if ($response->successful()) {
                Log::info('IRS A2A: GetStatus successful.', ['status' => $response->status(), 'endpoint' => $endpoint]);
                return $response->body(); // Return the raw XML response
            } else {
                Log::error('IRS A2A: GetStatus call failed.', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'endpoint' => $endpoint
                ]);
                // You might want to return the error body or throw an exception
                 return null; // Indicate failure
            }
        } catch (Exception $e) {
            Log::error('IRS A2A: Exception during GetStatus call.', [
                 'message' => $e->getMessage(),
                 'endpoint' => $endpoint,
                 'trace' => $e->getTraceAsString()
            ]);
            return null; // Indicate failure
        }
    }

    // TODO: Implement refresh token logic if applicable/needed.
    // The IRS documentation (Table 3-2) mentions a refresh token might be returned.
    // The standard refresh grant type uses 'grant_type=refresh_token' and the 'refresh_token' parameter.
    // Client authentication might still be needed (potentially the Client JWT again).

    public function testIrsA2aConnection(Request $request)
    {
        //Dummy for now

        return response()->json([
            'status' => 'success',
            'message' => 'IRS A2A connection test successful.',
            'data' => [
                'config' => 'configsadasd' ,
                'request' => $request->all(),
            ]
        ]);
    }
}