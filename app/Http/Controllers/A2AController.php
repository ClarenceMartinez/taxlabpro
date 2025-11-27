<?php

namespace App\Http\Controllers;

use App\Services\A2AService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class A2AController extends Controller
{
    protected $a2aService;

    public function __construct(A2AService $a2aService)
    {
        $this->a2aService = $a2aService;
    }

    public function submit(Request $request)
    {
        // Assume $xmlData contains your prepared IRIS XML submission string
        $xmlData = $request->input('xml_submission'); // Or load from file, generate, etc.

        if (empty($xmlData)) {
             return response()->json(['error' => 'No XML data provided'], 400);
        }

        $result = $this->a2aService->submitInformationReturn($xmlData);

        if (isset($result['error'])) {
            Log::error('IRS Submission failed in controller.', ['result' => $result]);
            return response()->json($result, $result['status'] ?? 500);
        }

        Log::info('IRS Submission successful in controller.', ['result' => $result]);
        return response()->json($result);
    }
    public function call(Request $request)
    {
        $result = $this->a2aService->testIrsA2aConnection($request);

        if (!isset($result) ) {
            Log::error('IRS Submission failed in controller.', ['result' => $result]);
            return $result;
        }

        Log::info('IRS Submission successful in controller.', ['result' => $result]);
        return $result;
    }
    public function dev(Request $request)
    {
        $config = config('services.irs_a2a');
        $title = 'Development Dashboard';
        return view('dev.dash', ['config' => $config, 'title' => $title]);
    }
     public function checkStatus(Request $request, string $receiptId)
    {
        // You'll need the TCC associated with the submission
        $tcc = config('services.irs_a2a.your_transmitter_tcc'); // Add TCC to config if static

        if (empty($tcc)) {
             return response()->json(['error' => 'Transmitter TCC not configured'], 500);
        }

        $xmlResponse = $this->a2aService->getTransmissionStatus($receiptId, 'RID', $tcc);

        if ($xmlResponse === null) {
            Log::error('IRS GetStatus failed in controller.', ['receiptId' => $receiptId]);
            return response()->json(['error' => 'Failed to retrieve status'], 500);
        }

        Log::info('IRS GetStatus successful in controller.', ['receiptId' => $receiptId]);
        // Return the raw XML, or parse it and return JSON
        return response($xmlResponse, 200)->header('Content-Type', 'application/xml');
    }
}
