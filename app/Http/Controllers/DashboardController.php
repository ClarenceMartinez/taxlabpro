<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Services\TranscriptParserService;
use Illuminate\Support\Facades\Storage;
use App\Models\Files;

use App\Traits\ManagesUserPermissions;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use App\Models\PayPeriod;
use App\Models\BankAccountType;
use App\Models\BusinessType;
use App\Models\StateOfAmerica;
use App\Models\AccountType;
use App\Models\Preset;
use App\Models\Company;

use App\Http\Requests\ClientRequest;
use Illuminate\Support\Str;
use App\Models\UserClient;
use App\Events\ClientListUpdated;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{
    use ManagesUserPermissions; 
    private const MAX_FILE_SIZE_KB = 10240; 
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'zip', 'rar', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'html']; // Added 'html'
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg', 'image/png', 'image/gif',
        'application/pdf',
        'application/zip', 'application/x-rar-compressed', 'application/vnd.rar',
        'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // doc, docx
        'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xls, xlsx
        'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', // ppt, pptx
        'text/plain', // txt
        'text/html' // Added 'text/html'
    ];

    protected TranscriptParserService $transcriptParserService;
    const CLIENT_PRIVATE_BASE_PATH = 'private/clients';

    private array $clientDirectoryStructure = [
        'Financials' => [
            'Monthly Expenses',
            '433A Completed',
            'Bank Statements',
            'Tax Returns',
        ],
        'Forms' => [],
        'Letters' => [
            'State Letters',
            'IRS Letters',
        ],
        'Transcripts' => [
            'Account Transcripts',
            'Tax Return Transcripts',
            'Wage & Income Summary',
            'Wage & Income Transcripts',
        ],
        'Invoices' => [
            'Signed Agreement',
            'Payment Forms',
        ],
        'Resolution' => [
            'Sent to IRS',
            'Recieved from IRS',
        ],
        'Recent Uploads' => [],
        'Generated' => [],
    ];
      public function __construct(TranscriptParserService $transcriptParserService) // Inject service
    {
        $this->transcriptParserService = $transcriptParserService;
        //$this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();

        $userName = $user->name;

        $companyName = 'TaxLabPro'; // Valor por defecto
        if ($user->company_id) {
            $company = Company::find($user->company_id);
            if ($company) {
                $companyName = $company->name;
            }
        }
        $clients = collect();
        $cliente = null;

        $baseQuery = Client::query();

        if ($user->type == 1) {
            // Sin filtro, puede ver todo
        } elseif ($user->type == 2) {
            $baseQuery->where('company_id', $user->company_id);
        } elseif ($user->type == 3) {
            $baseQuery->whereHas('userClients', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        } else {
            abort(403, 'Unauthorized access to clients.');
        }

        $clients = $baseQuery->clone()->orderBy('first_name', 'asc')->get();
        $cliente = $baseQuery->clone()->orderBy('updated_at', 'desc')->first();
        
        if (!$cliente) {
            return view('client.protodetail', [
                'clients'                   => $clients,
                'client'                    => null,
                'initialFileStructure'      => [],
                'initialBreadcrumbs'        => [],
                'defaultDirectoryStructure' => $this->clientDirectoryStructure,
                'payPeriods'                => PayPeriod::all(),
                'bankAccountType'           => BankAccountType::all(),
                'businessTypes'             => BusinessType::all(),
                'states_of_america'         => StateOfAmerica::all(),
                'accountTypes'              => AccountType::all(),
                'presets'                   => Preset::all(),
                'taxReturnTranscripts'      => [],
                'accountTranscripts'        => [],
                'title'                     => 'Module Client | Plataform TaxlabPro',
                'userName'                  => $userName,
                'companyName'               => $companyName,
            ])->with('info', 'No clients found for this user.');
        }

        
        $cliente->load([
            'avatar', 'dependents', 'employment', 'employment_spouse',
            'business_interests', 'lawsuits', 'lawsuit_irs', 'bankruptcies',
            'beneficiaries_insurance', 'trustees', 'trustFunds', 'safeDepositBoxes',
            'livedAbroads', 'assetAbroads', 'bankAccounts', 'investmentAccounts',
            'digitalAssets', 'retirementAccounts', 'creditAccounts', 'lifeInsurances',
            'assetTransfers', 'realEstateTransfers', 'typeResidence', 'properties',
            'propertySales', 'vehicles', 'otherAssets', 'paymentProcessors',
            'creditCards', 'businessBankAccounts', 'companyBankAccounts',
            'companyDigitalAssets', 'companyAccountReceivables', 'companyToolEquipments',
            'companyIntangibleAssets', 'incomeExpensePeriods', 'ecommerceProcessors',
            'partnersOfficers', 'businessAffiliations', 'payrollServiceProviders',
            'relatedPartiesOweBusiness', 'taxpayerLawsuitsIrs', 'businessAssetTransfers',
            'incomeChanges', 'safe', 'receivables', 'creditLines',
            'foreignProperties', 'intangibleAssets', 'businessLiabilities',
            'monthlyFinancial'
        ]);
        $cliente->loadCount(['activities', 'files', 'notes']);

        $initialFileStructure = $this->getClientFileStructure($cliente, '');
        $initialBreadcrumbs = $this->generateBreadcrumbs('');
        $defaultDirectoryStructure = $this->clientDirectoryStructure;

        $taxReturnTranscripts = $this->transcriptParserService->getTaxReturnTranscripts($cliente->id, $cliente->storage_path);
        $accountTranscripts = $this->transcriptParserService->getAccountTranscripts($cliente->id, $cliente->storage_path);

        $whtView = "client.protodetail";
        return view($whtView, [
            'clients'                   => $clients,
            'initialFileStructure'      => $initialFileStructure,
            'initialBreadcrumbs'        => $initialBreadcrumbs,
            'defaultDirectoryStructure' => $defaultDirectoryStructure,
            'client'                    => $cliente,
            'payPeriods'                => PayPeriod::all(),
            'bankAccountType'           => BankAccountType::all(),
            'businessTypes'             => BusinessType::all(),
            'states_of_america'         => StateOfAmerica::all(),
            'accountTypes'              => AccountType::all(),
            'id'                        => $cliente->id,
            'taxReturnTranscripts'      => $taxReturnTranscripts,
            'accountTranscripts'        => $accountTranscripts,
            'presets'                   => Preset::all(),
            'title'                     => 'Module Client | Plataform TaxlabPro',
            // --- MODIFICACIÓN: Pasar las nuevas variables a la vista ---
            'userName'                  => $userName,
            'companyName'               => $companyName,
        ]);
    }
    private function checkClientAccessAuthorization(Client $client = null, User $user, bool $allowUnassignedAdmin = true): bool
    {
        if (!$client) return false; // Si el cliente no existe, no hay autorización
        if ($user->type == 1) { // Super admin
            return true;
        }
        if ($user->type == 2 && $client->company_id == $user->company_id) { // Admin de la misma compañía
            // Si $allowUnassignedAdmin es true, el admin de la compañía tiene acceso incluso sin asignación directa.
            // Si es false, requiere asignación directa (útil para PDFs que solo deberían ver asignados).
            // Para la mayoría de las operaciones CRUD del cliente, true es lo común.
            return $allowUnassignedAdmin ? true : UserClient::where('client_id', $client->id)->where('user_id', $user->id)->exists();
        }
        // Usuario tipo 3 o 4 (o cualquier otro que requiera asignación directa)
        // Para estos tipos, siempre se requiere asignación directa.
        if (in_array($user->type, [3, 4])) {
            return UserClient::where('client_id', $client->id)
                             ->where('user_id', $user->id)
                             ->exists();
        }
        return false; // Por defecto, no autorizado
    }
    public function getClientListHtml(Request $request): Renderable
    {
        $user = Auth::user();

        // [LÓGICA REUTILIZADA] Usamos la misma lógica de consulta segura del método index()
        // para asegurar que cada usuario solo vea los clientes que le corresponden.
        $baseQuery = Client::query();

        if ($user->type == 1) {
            // El Superadmin ve todos los clientes, no se aplica filtro de compañía.
        } elseif ($user->type == 2) {
            $baseQuery->where('company_id', $user->company_id);
        } elseif ($user->type == 3) {
            $baseQuery->whereHas('userClients', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        } else {
            // Si por alguna razón un usuario sin tipo llega aquí, se le deniega el acceso.
            abort(403, 'Unauthorized access to clients.');
        }

        $clients = $baseQuery->orderBy('first_name', 'asc')->get();

        // Obtenemos el ID del cliente activo de la petición AJAX, si se envía.
        // Esto permite que el JavaScript mantenga seleccionado al cliente correcto.
        $activeClientId = $request->input('active_client_id', null);

        // Devolvemos la vista parcial. Laravel la renderizará a HTML automáticamente.
        return view('client.partials._client_list_items', [
            'clients' => $clients,
            'client_id_active' => $activeClientId
        ]);
    }
    public function quickStore(ClientRequest $request)
    {
        if (!Auth::check() || !$request->ajax()) {
            return response()->json(['status' => false, 'msg' => 'Invalid Request.', 'type' => 'error'], 400);
        }

        $user = Auth::user();
        if (!in_array($user->type, [1, 2, 3])) {
            return response()->json(['status' => false, 'msg' => 'Unauthorized.', 'type' => 'error'], 403);
        }

        try {
            $validatedData = $request->validated();

            $clientData = array_merge($validatedData, [
                'estatus'       => 1,
                'avatar'        => 1,
                'case_status'   => 1,
                'company_id'    => $user->company_id,
            ]);

            // Al crear el cliente aquí, el ClientObserver se disparará automáticamente.
            $client = Client::create($clientData);

            // El resto de la lógica de creación (storage, slug, etc.) permanece igual.
            $clientStorageFolderName = 'client_' . $client->id;
            $clientRelativeStoragePath = self::CLIENT_PRIVATE_BASE_PATH . '/' . $clientStorageFolderName;
            $client->storage_path = $clientRelativeStoragePath;
            
            $slugBase = !empty($client->business_name) ? $client->business_name : ($client->first_name . ' ' . $client->last_name);
            $uniqueSuffix = Str::random(4);
            $client->slug = Str::slug($slugBase . '-' . $client->id . '-' . $uniqueSuffix);
            $client->save();

            $this->createClientDirectoryStructure($client);

            if ($user->type == 3) {
                UserClient::create([
                    'client_id' => $client->id,
                    'user_id'   => $user->id
                ]);
            }

            // --- LÓGICA DE RESPUESTA PARA EL CREADOR ---
            // Preparamos el HTML solo para la respuesta JSON, ya no para el broadcast.
            $updatedClientsQuery = Client::query()->where('company_id', $user->company_id);
            if ($user->type == 3) {
                $updatedClientsQuery->whereHas('userClients', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            }
            $updatedClients = $updatedClientsQuery->orderBy('first_name', 'asc')->get();
 
            //$html = view('client.partials._client_list_items', ['clients' => $updatedClients,'client_id_active' => $client->id])->render();

            // [ELIMINADO] Ya no disparamos el evento desde aquí.
            // broadcast(new ClientListUpdated(...))->toOthers(); 
            
            return response()->json([
                'status'    => true,
                'msg'       => 'Client created successfully.',
                'type'      => 'success',
                'title'     => 'Success!',
                //'new_html' => $html,
                'new_count' => $updatedClients->count()
            ]);

        } catch (ValidationException $e) {
            return response()->json(['status' => false, 'msg' => 'Validation failed.', 'errors' => $e->errors(), 'type' => 'validation_error'], 422);
        } catch (\Exception $e) {
            \Log::error("Error in quickStore client: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());
            return response()->json(['status' => false, 'msg' => 'An unexpected error occurred.', 'type' => 'error'], 500);
        }
    }
    public function getClientHeaderAjax(Request $request)
    {
        $validated = $request->validate(['client_id' => 'required|integer']);
        $client = Client::find($validated['client_id']);

        if (!$client) {
            return response()->json(['success' => false, 'message' => 'Client not found.'], 404);
        }

        // Autorización
        $user = Auth::user();
        if (!$this->checkClientAccessAuthorization($client, $user)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized access.'], 403);
        }

        // Cargar solo las relaciones y datos MÍNIMOS que necesita el header.
        // Esto es mucho más eficiente que cargar todo el perfil.
        $client->loadCount(['notes', 'files']); // Ejemplo, ajusta a tus necesidades.
        
        // Simular otras dependencias si el header las necesita.
        $parserService = app(TranscriptParserService::class);
        $accountTranscripts = $parserService->getAccountTranscripts($client->id, $client->storage_path);

        $dataForView = [
            'client' => $client,
            'accountTranscripts' => $accountTranscripts,
            'pendingTasksCount' => 0, // Placeholder
            'dealAmount' => 0, // Placeholder
        ];
        
        // Asumiremos que tienes un parcial solo para el header. Si no, podemos crearlo.
        // Por ahora, usaremos tu parcial existente pero es menos eficiente.
        // Idealmente, deberías crear `client.partials._client-profile-header.blade.php`
        // y mover el contenido de la tarjeta del header allí.
        
        // Supongamos que tu header está en `client.partials.main-info-client`
        // Para ser precisos, vamos a renderizar el parcial que contiene el header.
        // Para simplificar, asumimos que es este:
        $html = view('client.partials.main-info-client', $dataForView)->render();

        return response()->json(['success' => true, 'html' => $html]);
    }
    public function updateStatusAjax(Request $request, $clientId)
    {
        // 1. Búsqueda Manual del Modelo
        // Usamos findOrFail para que devuelva un error 404 si el cliente no existe.
        try {
            $client = Client::findOrFail($clientId);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Client not found.'], 404);
        }

        // 2. Autorización
        $user = Auth::user();
        // Asumo una lógica de autorización simple. Ajústala si es necesario.
        if ($user->company_id !== $client->company_id) { 
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        // 3. Validación
        $validator = Validator::make($request->all(), [
            'case_status' => 'required|integer|in:1,2,3,4,5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid status provided.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // 4. Lógica de Actualización
        try {
            $client->case_status = $request->input('case_status');
            $client->save(); // Esto disparará tu ClientObserver y el evento de Echo.

            // 5. Respuesta de Éxito
            return response()->json([
                'success' => true,
                'message' => 'Client status update request sent successfully.',
            ]);

        } catch (\Exception $e) {
            \Log::error("Error updating client status (ID: {$client->id}): " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred on the server.',
            ], 500);
        }
    }
    public function updateProfileAjax(Request $request, $client)
    {
        $clientId = $client; // Asignamos el ID a una variable más clara

        // 1. Búsqueda manual del cliente
        $client = Client::find($clientId);

        if (!$client) {
            return response()->json(['success' => false, 'message' => 'Client not found.'], 404);
        }

        // 2. Autorización: Reutilizamos tu helper
        $user = Auth::user();
        if (!$this->checkClientAccessAuthorization($client, $user)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized access.'], 403);
        }

        // 3. Validación: Definimos las reglas (esto permanece igual)
        $validator = Validator::make($request->all(), [
            'first_name'         => 'nullable|string|max:255',
            'mi'                 => 'nullable|string|max:255',
            'last_name'          => 'nullable|string|max:255',
            // ... todas tus otras reglas de validación ...
            'ssn'                => 'nullable|string|max:255',
            'date_birdth'        => 'nullable|date',
            'address_1'          => 'nullable|string|max:255',
            'city'               => 'nullable|string|max:255',
            'state'              => 'nullable|string|max:255',
            'zipcode'            => 'nullable|string|max:255',
            'country'            => 'nullable|string|max:255',
            'marital_status'     => 'nullable|in:1,2',
            'marital_date'       => 'nullable|date',
            'spouse_first_name'  => 'nullable|string|max:255',
            'spouse_last_name'   => 'nullable|string|max:255',
            'spouse_ssn'         => 'nullable|string|max:255',
            'spouse_date_birdth' => 'nullable|date',
            'phone_home'         => 'nullable|string|max:255',
            'cell_home'          => 'nullable|string|max:255',
            'tax_payer_email'    => 'nullable|email|max:255',
            'spouse_email'       => 'nullable|email|max:255',
            'tags'               => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors()
            ], 422);
        }

        // 4. Lógica de Actualización (esto permanece igual)
        try {
            $client->fill($validator->validated());
            $client->save();

            return response()->json([
                'success' => true,
                'message' => 'Client updated successfully.'
            ]);

        } catch (\Exception $e) {
            \Log::error("Error updating client profile (ID: {$client->id}): " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred on the server.'
            ], 500);
        }
    }
    public function getClientDetailsAjax(Request $request)
    {
        // 1. Validar que el client_id venga en la petición
        $validated = $request->validate([
            'client_id' => 'required|integer|exists:clients,id'
        ]);

        $clientId = $validated['client_id'];

        // 2. Búsqueda manual del cliente (como lo hicimos antes)
        $client = Client::find($clientId);

        // 3. Autorización (tu lógica existente)
        $user = Auth::user();
        if (!$this->checkClientAccessAuthorization($client, $user)) {
            return response()->json(['success' => false, 'message' => 'You are not authorized to view this client.'], 403);
        }

        // --- A PARTIR DE AQUÍ, EL RESTO DEL CÓDIGO ES IGUAL ---
        
        // 4. Cargar relaciones, datos adicionales, etc.
        $client->load([ /* ... todas tus relaciones ... */ ]);
        $client->loadCount(['activities', 'files', 'notes']);

        // ... (resto de la lógica para cargar datos, como getClientFileStructure, etc.) ...
        $initialFileStructure = $this->getClientFileStructure($client, '');
        $initialBreadcrumbs = $this->generateBreadcrumbs('');
        $taxReturnTranscripts = $this->transcriptParserService->getTaxReturnTranscripts($client->id, $client->storage_path);
        $accountTranscripts = $this->transcriptParserService->getAccountTranscripts($client->id, $client->storage_path);


        // 5. Preparar los datos para la vista parcial
        $dataForView = [
            'client'                    => $client,
            'initialFileStructure'      => $initialFileStructure,
            'initialBreadcrumbs'        => $initialBreadcrumbs,
            'defaultDirectoryStructure' => $this->clientDirectoryStructure,
            'payPeriods'                => PayPeriod::all(),
            'bankAccountType'           => BankAccountType::all(),
            'businessTypes'             => BusinessType::all(),
            'states_of_america'         => StateOfAmerica::all(),
            'accountTypes'              => AccountType::all(),
            'id'                        => $client->id,
            'taxReturnTranscripts'      => $taxReturnTranscripts,
            'accountTranscripts'        => $accountTranscripts,
            'presets'                   => Preset::all(),
            'pendingTasksCount'         => 0,
            'dealAmount'                => 0, 
        ];

        // 6. Renderizar SOLO la vista parcial a HTML
        $html = view('client.partials.main-info-client', $dataForView)->render();

        // 7. Devolver el HTML en una respuesta JSON
        return response()->json([
            'success' => true,
            'html'    => $html
        ]);
    }
    private function getClientFileStructure(Client $client, string $currentRelativePath = ''): array
    {
        $structure = ['folders' => [], 'files' => []];
        if (empty($client->storage_path)) {
            \Log::warning("Client ID {$client->id} no tiene storage_path para getClientFileStructure.");
            return $structure;
        }

        $clientDiskBasePath = $client->storage_path;
        $currentDiskPath = $clientDiskBasePath . (!empty($currentRelativePath) ? '/' . ltrim($currentRelativePath, '/') : '');
        $currentDiskPath = rtrim(str_replace('//', '/', $currentDiskPath), '/');


        if (!Storage::disk('local')->exists($currentDiskPath)) {
            \Log::warning("La ruta física no existe en el disco para el cliente {$client->id}: {$currentDiskPath}");
            return $structure;
        }

        $directories = Storage::disk('local')->directories($currentDiskPath);
        foreach ($directories as $dirFullPath) {
            $folderName = basename($dirFullPath);
            $folderRelativePath = (!empty($currentRelativePath) ? ltrim($currentRelativePath, '/') . '/' : '') . $folderName;
            $structure['folders'][] = [
                'name' => $folderName,
                'path' => $folderRelativePath,
            ];
        }
        // Normaliza $currentDiskPath para la consulta y comparación (sin slash al final)
        $normalizedCurrentDiskPath = rtrim($currentDiskPath, '/');

        $filesInDb = Files::where('client_id', $client->id)
            ->where('url', 'like', $normalizedCurrentDiskPath . ($normalizedCurrentDiskPath === $client->storage_path ? '%' : '/%')) // Adjusted like for root
            ->with('user:id,name')
            ->get();


        foreach ($filesInDb as $fileRecord) {
            $fileStoredDir = dirname($fileRecord->url);
            if (rtrim($fileStoredDir, '/') === $normalizedCurrentDiskPath) {
                $fileSize = 0;
                try {
                    if(Storage::disk('local')->exists($fileRecord->url)) {
                        $fileSize = Storage::disk('local')->size($fileRecord->url);
                    } else {
                        \Log::warning("Archivo en BD (ID: {$fileRecord->id}) no encontrado en disco: {$fileRecord->url} para cliente {$client->id}");
                    }
                } catch(\Exception $e) {
                    \Log::error("Error al obtener tamaño del archivo {$fileRecord->url} (ID: {$fileRecord->id}): ".$e->getMessage());
                }

                $structure['files'][] = [
                    'id' => $fileRecord->id,
                    'name' => basename($fileRecord->url),
                    'original_name' => $fileRecord->original_name ?? basename($fileRecord->url),
                    'size' => $fileSize,
                    'uploaded_at' => $fileRecord->created_at ? $fileRecord->created_at->format('d/m/Y H:i') : 'N/A',
                    'uploaded_by' => $fileRecord->user->name ?? 'N/A',
                    'icon' => $this->getFileIconClass($fileRecord->ext),
                    'download_url' => route('clients.file.download', ['fileId' => $fileRecord->id]),
                    'view_url' => route('clients.file.view', ['fileId' => $fileRecord->id]) // Added view_url
                ];
            }
        }
        return $structure;
    }
    private function generateBreadcrumbs(string $relativePath): array
    {
        $breadcrumbs = [['name' => 'Root', 'path' => '']]; // Carpeta raíz del cliente
        if (empty($relativePath)) {
            return $breadcrumbs;
        }
        $parts = explode('/', $relativePath);
        $currentPath = '';
        foreach ($parts as $part) {
            if (!empty($part)) {
                $currentPath .= (empty($currentPath) ? '' : '/') . $part;
                $breadcrumbs[] = ['name' => $part, 'path' => $currentPath];
            }
        }
        return $breadcrumbs;
    }
    private function createClientDirectoryStructure(Client $client): bool
    {
        if (empty($client->storage_path)) {
            \Log::error("Client ID {$client->id} does not have a storage_path defined.");
            return false;
        }

        $baseClientPath = $client->storage_path; // e.g., "private/client_123"

        try {
            // Crear el directorio raíz del cliente primero (relativo a storage/app/)
            if (!Storage::disk('local')->exists($baseClientPath)) {
                Storage::disk('local')->makeDirectory($baseClientPath);
            }

            $this->createNestedDirectories($baseClientPath, $this->clientDirectoryStructure);
            return true;

        } catch (\Exception $e) {
            \Log::error("Failed to create directory structure for client ID {$client->id} at {$baseClientPath}: " . $e->getMessage());
            return false;
        }
    }
    private function createNestedDirectories(string $currentPath, array $directoriesStructure)
    {
        foreach ($directoriesStructure as $key => $value) {
            $dirName = is_string($key) ? $key : $value;
            // La ruta es relativa al disco 'local'
            $fullPath = rtrim($currentPath, '/') . '/' . $dirName;

            if (!Storage::disk('local')->exists($fullPath)) {
                Storage::disk('local')->makeDirectory($fullPath); // makeDirectory es recursivo por defecto
            }

            // Si $value es un array, significa que hay subdirectorios
            if (is_array($value) && !empty($value)) {
                $this->createNestedDirectories($fullPath, $value);
            }
        }
    }
    public function files_post(Request $request)
    {
        // 1. Autenticación
        if (!Auth::check()) {
            return response()->json(['status' => false, 'msg' => 'Unauthenticated.', 'type' => 'error'], 401);
        }

        $user = Auth::user();

        // 2. Validación de la Solicitud
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer|exists:clients,id',
            'target_directory' => 'nullable|string|max:255', // Max length para la ruta relativa
            'file' => [
                'required',
                'file',
                'mimes:' . implode(',', self::ALLOWED_EXTENSIONS),
                'max:' . self::MAX_FILE_SIZE_KB,
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg'    => 'Validation failed.',
                'errors' => $validator->errors(),
                'type'   => 'validation_error'
            ], 422);
        }

        $validatedData = $validator->validated();
        $clientId = $validatedData['client_id'];
        $client = Client::find($clientId);

        // 3. Verificar Cliente y Ruta de Almacenamiento Base
        if (!$client || empty($client->storage_path)) {
            \Log::error("Upload attempt for non-existent client or client (ID: {$clientId}) without storage_path.");
            return response()->json(['status' => false, 'msg' => 'Client not found or storage path not configured for the client.', 'type' => 'error'], 404);
        }

        // 4. Autorización
        if (!$this->checkClientAccessAuthorization($client, $user)) {
            return response()->json(['status' => false, 'msg' => 'Unauthorized to upload files for this client.', 'type' => 'error'], 403);
        }

        // 5. Validación Adicional del Tipo MIME (más segura)
        $file = $request->file('file');
        if (!in_array($file->getMimeType(), self::ALLOWED_MIME_TYPES)) {
            return response()->json([
                'status' => false,
                'msg'    => 'Invalid file type detected.',
                'errors' => ['file' => ['The uploaded file type is not allowed. Actual type: ' . $file->getMimeType()]],
                'type'   => 'validation_error'
            ], 422);
        }

        // 6. Procesamiento del Nombre y Ruta del Archivo
        $originalName = $file->getClientOriginalName();
        // Sanitizar nombre base del archivo para evitar caracteres problemáticos en el sistema de archivos
        $sanitizedBaseName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME), '_');
        $extension = strtolower($file->getClientOriginalExtension()); // Usar extensión en minúsculas
        $fileName = time() . '_' . $sanitizedBaseName . '.' . $extension;

        $clientBaseStoragePath = $client->storage_path; // e.g., "private/client_123"

        // Determinar y sanitizar el subdirectorio de destino
        // Si target_directory es una cadena vacía (desde la raíz del cliente), $targetSubdirectory será "".
        $targetSubdirectory = $validatedData['target_directory'] ?? ''; // Default a raíz del cliente si es null

        // Sanitización robusta del target_directory
        $targetSubdirectory = str_replace('..', '', $targetSubdirectory);
        $targetSubdirectory = str_replace('\\', '/', $targetSubdirectory);
        $targetSubdirectory = preg_replace('/\/+/', '/', $targetSubdirectory);
        $targetSubdirectory = trim($targetSubdirectory, '/');

        // Construir la ruta relativa final DENTRO del disco 'local'
        $finalRelativePathInsideDisk = $clientBaseStoragePath;
        if (!empty($targetSubdirectory)) {
            $finalRelativePathInsideDisk .= '/' . $targetSubdirectory;
        }
        // Normalizar: quitar slashes duplicados y slashes al final
        $finalRelativePathInsideDisk = rtrim(str_replace('//', '/', $finalRelativePathInsideDisk), '/');


        // 7. Crear el Directorio de Destino si no Existe
        if (!Storage::disk('local')->exists($finalRelativePathInsideDisk)) {
            try {
                Storage::disk('local')->makeDirectory($finalRelativePathInsideDisk); // Es recursivo
            } catch (\Exception $e) {
                \Log::error("Failed to create target directory {$finalRelativePathInsideDisk} for client {$clientId}: " . $e->getMessage());
                return response()->json(['status' => false, 'msg' => 'Server error: Could not create target directory for upload.', 'type' => 'error'], 500);
            }
        }

        // 8. Mover/Guardar el Archivo
        try {
            // `storeAs` espera: path relativo al disco, nombre del archivo, disco.
            // $finalRelativePathInsideDisk ya es relativo al disco 'local' (e.g., private/client_123/TargetFolder)
            $file->storeAs($finalRelativePathInsideDisk, $fileName, 'local');

            // La ruta completa que se guardará en la BD (relativa al raíz del disco 'local')
            $pathInStorageForDB = $finalRelativePathInsideDisk . '/' . $fileName;
            $pathInStorageForDB = str_replace('//', '/', $pathInStorageForDB); // Normalizar

        } catch (\Exception $e) {
            \Log::error("Failed to store uploaded file for client {$clientId} at {$finalRelativePathInsideDisk}/{$fileName}: " . $e->getMessage());
            return response()->json(['status' => false, 'msg' => 'Failed to save uploaded file due to a server error.', 'type' => 'error'], 500);
        }

        // 9. Guardar Registro en la Base de Datos
        try {
            Files::create([
                'url'       => $pathInStorageForDB, // Ruta relativa al disco 'local' (storage/app)
                'client_id' => $clientId,
                'user_id'   => $user->id,
                'ext'       => $extension,
                'original_name' => $originalName, // Opcional: guardar nombre original
            ]);

            // log_client_activity($clientId, 'File Uploaded', "User {$user->name} uploaded file '{$originalName}' to '{$targetSubdirectory}'.");

            // $this->enviarCorreo($client, $user, "has uploaded a new file '{$originalName}'");

            return response()->json([
                'status'    => true,
                'msg'       => 'Successfully uploaded file.',
                'type'      => 'success',
                'title'     => 'Perfect!',
                'file_path' => $pathInStorageForDB,
            ]);

        } catch (\Exception $e) {
            $filePathToDelete = $finalRelativePathInsideDisk . '/' . $fileName;
            if (Storage::disk('local')->exists($filePathToDelete)) {
                Storage::disk('local')->delete($filePathToDelete);
            }
            \Log::error("Failed to save file record to database for client {$clientId} (file: {$filePathToDelete}): " . $e->getMessage());
            return response()->json(['status' => false, 'msg' => 'File uploaded but failed to save its record to the database.', 'type' => 'error'], 500);
        }
    }
    public function downloadClientFile(Request $request, $fileId)
    {
        if (!Auth::check()) {
            abort(401, 'Unauthenticated.');
        }

        $user = Auth::user();
        $fileRecord = Files::find($fileId);

        if (!$fileRecord) {
            abort(404, 'File not found in database.');
        }

        $client = Client::find($fileRecord->client_id);
        if (!$client) {
            abort(404, 'Associated client not found.');
        }

        if (!$this->checkClientAccessAuthorization($client, $user)) {
             abort(403, 'Unauthorized to access this file.');
        }

        $filePathInStorage = $fileRecord->url;

        if (!Storage::disk('local')->exists($filePathInStorage)) {
            \Log::error("File record exists (ID: {$fileId}) but physical file not found at: {$filePathInStorage}");
            abort(404, 'File not found on server.');
        }

        $originalFileName = $fileRecord->original_name ?? basename($filePathInStorage); // Usar original_name si existe

        // log_client_activity($client->id, 'File Downloaded', "User {$user->name} downloaded file: {$originalFileName}");

        return Storage::disk('local')->download($filePathInStorage, $originalFileName);
    }
    public function generateDifferentModules($client)
    {
        Dependent::create(['client_id' => $client['id']]);
        Employment::create(['client_id' => $client['id']]);
        EmploymentSpouse::create(['client_id' => $client['id']]);
        BusinessInterest::create(['client_id' => $client['id']]);
        Lawsuit::create(['client_id' => $client['id']]);
        LawsuitIRS::create(['client_id' => $client['id']]);
        Bankruptcy::create(['client_id' => $client['id']]);
        BeneficiaryInsurance::create(['client_id' => $client['id']]);
        Trustee::create(['client_id' => $client['id']]);
        TrustFund::create(['client_id' => $client['id']]);

        SafeDepositBox::create(['client_id' => $client['id']]);
        LivedAbroad::create(['client_id' => $client['id']]);
        AssetAbroad::create(['client_id' => $client['id']]);

        BankAccount::create(['client_id' => $client['id']]);
        InvestmentAccount::create(['client_id' => $client['id']]);
        DigitalAsset::create(['client_id' => $client['id']]);
        RetirementAccount::create(['client_id' => $client['id']]);
        CreditAccount::create(['client_id' => $client['id']]);
        LifeInsurance::create(['client_id' => $client['id']]);
        AssetTransfer::create(['client_id' => $client['id']]);
        RealEstateTransfer::create(['client_id' => $client['id']]);

        TypeResidence::create(['client_id' => $client['id']]);
        Property::create(['client_id' => $client['id']]);
        PropertySale::create(['client_id' => $client['id']]);
        Vehicle::create(['client_id' => $client['id']]);
        OtherAsset::create(['client_id' => $client['id']]);

        PaymentProcessor::create(['client_id' => $client['id']]);
        CreditCard::create(['client_id' => $client['id']]);
        BusinessBankAccount::create(['client_id' => $client['id']]);
        CompanyBankAccount::create(['client_id' => $client['id']]);
        CompanyDigitalAsset::create(['client_id' => $client['id']]);
        CompanyAccountReceivable::create(['client_id' => $client['id']]);
        CompanyToolEquipment::create(['client_id' => $client['id']]);
        CompanyIntangibleAsset::create(['client_id' => $client['id']]);
        IncomeExpensePeriod::create(['client_id' => $client['id']]);

        EcommerceProcessor::create(['client_id' => $client['id']]);
        PartnerOfficer::create(['client_id' => $client['id']]);
        BusinessAffiliation::create(['client_id' => $client['id']]);
        PayrollServiceProvider::create(['client_id' => $client['id']]);
        RelatedPartyOweBusiness::create(['client_id' => $client['id']]);
        TaxpayerLawsuitIrs::create(['client_id' => $client['id']]);
        BusinessAssetTransfer::create(['client_id' => $client['id']]);
        IncomeChange::create(['client_id' => $client['id']]);
        Safe::create(['client_id' => $client['id']]);

        Receivable::create(['client_id' => $client['id']]);
        CreditLine::create(['client_id' => $client['id']]);
        ForeignProperty::create(['client_id' => $client['id']]);
        IntangibleAsset::create(['client_id' => $client['id']]);
        BusinessLiability::create(['client_id' => $client['id']]);

        ClientService::create(['client_id' => $client['id']]);
        MonthlyFinancial::create(['client_id' => $client['id']]);

    }
    public function createClientFolderAjax(Request $request, $clientId)
    {
        $client = Client::findOrFail($clientId);
        $user = Auth::user();

        if (!$this->checkClientAccessAuthorization($client, $user)) {
            return response()->json(['status' => false, 'msg' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'current_view_path' => 'nullable|string', // La carpeta donde se está visualizando actualmente
            'new_folder_name' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s_-]+$/', // Validar nombre
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()], 422);
        }

        $currentViewPath = $request->input('current_view_path', '');
        $newFolderName = trim($request->input('new_folder_name'));

        // Sanitizar currentViewPath y newFolderName
        $currentViewPath = ltrim(str_replace('..', '', trim($currentViewPath)), '/');
        $newFolderName = Str::slug($newFolderName, '_'); // O usa una sanitización más simple si prefieres espacios

        $fullNewFolderPathDisk = $client->storage_path .
                                (!empty($currentViewPath) ? '/' . $currentViewPath : '') .
                                '/' . $newFolderName;
        $fullNewFolderPathDisk = rtrim(str_replace('//', '/', $fullNewFolderPathDisk), '/');


        if (Storage::disk('local')->exists($fullNewFolderPathDisk)) {
            return response()->json(['status' => false, 'msg' => 'Folder already exists.'], 409);
        }

        try {
            Storage::disk('local')->makeDirectory($fullNewFolderPathDisk);
            // log_client_activity($clientId, 'Folder Created', "User created folder: {$newFolderName} in {$currentViewPath}");
            return response()->json(['status' => true, 'msg' => 'Folder created successfully.']);
        } catch (\Exception $e) {
            \Log::error("Error creating folder {$fullNewFolderPathDisk} for client {$clientId}: " . $e->getMessage());
            return response()->json(['status' => false, 'msg' => 'Could not create folder.'], 500);
        }
    }
    public function deleteClientFileAjax(Request $request, $fileId)
    {
        $fileRecord = Files::find($fileId);
        if (!$fileRecord) {
            return response()->json(['status' => false, 'msg' => 'File not found.'], 404);
        }

        $client = Client::find($fileRecord->client_id);
        $user = Auth::user();

        if (!$this->checkClientAccessAuthorization($client, $user)) {
            return response()->json(['status' => false, 'msg' => 'Unauthorized'], 403);
        }

        try {
            if (Storage::disk('local')->exists($fileRecord->url)) {
                Storage::disk('local')->delete($fileRecord->url);
            }
            $fileName = basename($fileRecord->url);
            $fileRecord->delete(); // Borrar de la BD
            // log_client_activity($client->id, 'File Deleted', "User deleted file: {$fileName}");
            return response()->json(['status' => true, 'msg' => 'File deleted successfully.']);
        } catch (\Exception $e) {
            \Log::error("Error deleting file ID {$fileId} (path: {$fileRecord->url}): " . $e->getMessage());
            return response()->json(['status' => false, 'msg' => 'Could not delete file.'], 500);
        }
    }
    public function deleteClientFolderAjax(Request $request, $clientId)
    {
        $client = Client::findOrFail($clientId);
        $user = Auth::user();

        if (!$this->checkClientAccessAuthorization($client, $user)) {
            return response()->json(['status' => false, 'msg' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'folder_path_to_delete' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()], 422);
        }

        $folderPathRelative = ltrim(str_replace('..', '', trim($request->input('folder_path_to_delete'))), '/');
        if (empty($folderPathRelative)) { // No permitir borrar la raíz del cliente desde aquí
            return response()->json(['status' => false, 'msg' => 'Cannot delete client root folder.'], 400);
        }

        $folderPathDisk = $client->storage_path . '/' . $folderPathRelative;
        $folderPathDisk = rtrim(str_replace('//', '/', $folderPathDisk), '/');


        if (!Storage::disk('local')->exists($folderPathDisk)) {
            return response()->json(['status' => false, 'msg' => 'Folder not found on disk.'], 404);
        }

        // Verificar si la carpeta está en la estructura base (para no borrar accidentalmente otras)
        $isBaseStructureFolder = false;
        $pathParts = explode('/', $folderPathRelative);
        $tempStructure = $this->clientDirectoryStructure;
        $currentLevel = $tempStructure;
        $validPath = true;

        // No permitir borrar las carpetas de la estructura base directamente,
        // a menos que sea una subcarpeta creada por el usuario.
        // Por simplicidad, aquí solo prevenimos borrar las de primer nivel de la estructura base.
        // Una lógica más compleja podría verificar anidamiento.
        foreach ($this->clientDirectoryStructure as $baseKey => $baseValue) {
            if ( (is_string($baseKey) && $baseKey === $folderPathRelative) || (is_string($baseValue) && $baseValue === $folderPathRelative) ) {
                return response()->json(['status' => false, 'msg' => 'Cannot delete base structure folders.'], 400);
            }
        }


        try {
            // Antes de borrar el directorio, borrar todos los registros de `Files` dentro de él y subdirectorios
            $filesToDelete = Files::where('client_id', $clientId)
                                ->where('url', 'like', $folderPathDisk . '/%')
                                ->get();
            foreach($filesToDelete as $fileRec) {
                $fileRec->delete();
            }

            Storage::disk('local')->deleteDirectory($folderPathDisk);
            // log_client_activity($clientId, 'Folder Deleted', "User deleted folder: {$folderPathRelative}");
            return response()->json(['status' => true, 'msg' => 'Folder and its contents deleted successfully.']);
        } catch (\Exception $e) {
            \Log::error("Error deleting folder {$folderPathDisk} for client {$clientId}: " . $e->getMessage());
            return response()->json(['status' => false, 'msg' => 'Could not delete folder.'], 500);
        }
    }
    private function getFileIconClass(string $extension): string
    {
        $ext = strtolower($extension);
        $iconMap = [
            'pdf' => 'fa-file-pdf text-danger',
            'doc' => 'fa-file-word text-primary', 'docx' => 'fa-file-word text-primary',
            'xls' => 'fa-file-excel text-success', 'xlsx' => 'fa-file-excel text-success',
            'ppt' => 'fa-file-powerpoint text-warning', 'pptx' => 'fa-file-powerpoint text-warning',
            'zip' => 'fa-file-archive text-secondary', 'rar' => 'fa-file-archive text-secondary',
            'jpg' => 'fa-file-image text-info', 'jpeg' => 'fa-file-image text-info', 'png' => 'fa-file-image text-info', 'gif' => 'fa-file-image text-info',
            'txt' => 'fa-file-alt text-muted',
        ];
        return $iconMap[$ext] ?? 'fa-file text-muted'; // Icono por defecto
    }
    public function getClientFilesAjax(Request $request, $clientId)
    {
        $client = Client::findOrFail($clientId);
        $user = Auth::user();

        if (!$this->checkClientAccessAuthorization($client, $user)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $relativePath = $request->input('path', ''); // Ruta relativa desde el frontend
        // Sanitizar $relativePath para evitar traversals (../../)
        $relativePath = str_replace('..', '', $relativePath); // Simple sanitización, mejorar si es necesario
        $relativePath = ltrim(trim($relativePath), '/');


        $fileStructure = $this->getClientFileStructure($client, $relativePath);
        $defaultDirectories = $this->clientDirectoryStructure; // La estructura base definida en el controlador

        return response()->json([
            'path' => $relativePath,
            'structure' => $fileStructure,
            'default_dir_structure' => $defaultDirectories, // Para el select de subida
            'breadcrumbs' => $this->generateBreadcrumbs($relativePath)
        ]);
    }
}