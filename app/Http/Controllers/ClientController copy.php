<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt; 
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Mail\NotificacionCliente;
use Illuminate\Support\Facades\Mail;


use App\Models\Client;
use App\Models\Activities;
use App\Models\User;
use App\Models\UserClient;
use App\Traits\ManagesUserPermissions;
use App\Models\Notes;
use App\Models\Files;
use App\Models\HouseholdMembers;
use App\Models\Dependent;
use App\Models\Employment;
use App\Models\EmploymentSpouse;
use App\Models\BusinessInterest;
use App\Models\Lawsuit;
use App\Models\LawsuitIRS;
use App\Models\Bankruptcy;
use App\Models\BeneficiaryInsurance;
use App\Models\Trustee;
use App\Models\TrustFund;
use App\Models\SafeDepositBox;
use App\Models\LivedAbroad;
use App\Models\AssetAbroad;
use App\Models\BankAccount;
use App\Models\InvestmentAccount;
use App\Models\DigitalAsset;
use App\Models\RetirementAccount;
use App\Models\CreditAccount;
use App\Models\LifeInsurance;
use App\Models\AssetTransfer;
use App\Models\RealEstateTransfer;
use App\Models\TypeResidence;
use App\Models\Property;
use App\Models\PropertySale;
use App\Models\Vehicle;
use App\Models\OtherAsset;
use App\Models\PayPeriod;
use App\Models\BankAccountType;
use App\Models\BusinessType;
use App\Models\PaymentProcessor;
use App\Models\CreditCard;
use App\Models\BusinessBankAccount;
use App\Models\CompanyBankAccount;
use App\Models\CompanyDigitalAsset;
use App\Models\CompanyAccountReceivable;
use App\Models\CompanyToolEquipment;
use App\Models\CompanyIntangibleAsset;
use App\Models\IncomeExpensePeriod;
use App\Models\StateOfAmerica;
use App\Models\AccountType;

use App\Models\EcommerceProcessor;
use App\Models\PartnerOfficer;
use App\Models\BusinessAffiliation;
use App\Models\PayrollServiceProvider;
use App\Models\RelatedPartyOweBusiness;
use App\Models\TaxpayerLawsuitIrs;
use App\Models\BusinessAssetTransfer;
use App\Models\IncomeChange;
use App\Models\Safe;

use App\Models\Receivable;
use App\Models\CreditLine;
use App\Models\ForeignProperty;
use App\Models\IntangibleAsset;
use App\Models\BusinessLiability;
use App\Models\CompanyService;
use App\Models\ClientService;
use App\Models\MonthlyFinancial;
use App\Models\ClientActivityLog;

use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Validator; 
use Illuminate\Validation\ValidationException; 
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Notification;

use DataTables;

class ClientController extends Controller
{
    use ManagesUserPermissions; 
     // Define el tamaño máximo en kilobytes (KB). Ejemplo: 10MB = 10 * 1024 = 10240 KB
     private const MAX_FILE_SIZE_KB = 10240; 

     // Define las extensiones permitidas
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'zip', 'rar', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'];

    // Define los tipos MIME permitidos (más seguro que solo extensiones)
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg', 'image/png', 'image/gif',
        'application/pdf',
        'application/zip', 'application/x-rar-compressed', 'application/vnd.rar',
        'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // doc, docx
        'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xls, xlsx
        'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', // ppt, pptx
        'text/plain' // txt
    ];
        // Estructura de directorios para cada cliente
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
     // Definimos la ruta base para los archivos privados de los clientes
    private const CLIENT_PRIVATE_BASE_PATH = 'private'; // storage/app/private/

    public function index()
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();

        if (in_array($user->type, [1, 2])) {
            $data['users'] = User::select('id', 'name')
                ->withCount(['userClients as asigments'])
                ->where('type', 3)
                ->where('status', 1)
                ->where('company_id', $user->company_id)
                ->get();

            $data['users_all'] = User::select('id', 'name')
                ->where('status', 1)
                ->where('company_id', $user->company_id)
                ->get();
        } else {
            $data['users'] = null;
            $data['users_all'] = null;
        }

        $data['states_of_america'] = StateOfAmerica::all();
        $data['company_services'] = CompanyService::where('company_id', $user->company_id)->get();

        $data['title'] = 'Module Client | Plataform TaxlabPro';
        return view('client.list', $data);
    }
    public function pdf_f433a($id)
    {
        // 1. Autenticación
        if (!Auth::check()) { // Cambiado de empty(auth()->id()) a Auth::check() para consistencia
            return redirect('/');
        }
    
        // 1.5 Validación básica del ID (Recomendado)
        if (!is_numeric($id)) {
             abort(404, 'Formato de ID de cliente inválido.');
        }
        $idx = (int) $id; // Usar el ID validado y convertido a entero
    
        $user = Auth::user();
    
        // 2. Autorización (Adaptada de pdf_f433b)
        if ($user->type == 1) {
            // Super admin puede continuar
        }
        elseif ($user->type == 2) {
            $clientBelongsToCompany = Client::where('id', $idx)
                ->where('company_id', $user->company_id)
                ->exists();
            if (!$clientBelongsToCompany) {
                abort(403, 'Acceso no autorizado a los datos del cliente.');
            }
        }
        else { // Asumiendo que los usuarios tipo 3 necesitan asignación
            $clientAssignedToUser = UserClient::where('client_id', $idx)
                ->where('user_id', $user->id)
                ->exists();
            if (!$clientAssignedToUser) {
                abort(403, 'Acceso no autorizado a los datos del cliente.');
            }
        }
    
        // 3. Obtener datos del Cliente (Consulta corregida + Left Join + Verificación)
        $client = Client::select('clients.*', 'states_of_america.abrev as state_abrev', 'states_of_america.name as state_name')
                    ->leftJoin('states_of_america', 'states_of_america.id', 'clients.state') // Usar leftJoin
                    ->where('clients.id', $idx) // <-- ¡Filtrar por el ID correcto!
                    ->first();
    
        // 4. Manejar si el cliente no se encuentra
        if (!$client) {
             abort(404, 'Cliente no encontrado.');
             // O redirigir: return redirect()->route('clients.index')->with('error', 'Cliente no encontrado.');
        }
    
        // --- Obtener datos relacionados (usando el ID correcto $idx) ---
        $dependents                     = Dependent::where('client_id', $idx)->get();
        $businessInterests              = BusinessInterest::where('client_id', $idx)->get();
        $employments                    = Employment::select('employment.*', 'pay_periods.name as pay_period_name')
                                            ->leftjoin('pay_periods', 'pay_periods.id', 'employment.pay_period')
                                            ->where('client_id', $idx)->get(); // Usar $idx
        $employmentSpouses              = EmploymentSpouse::select('employment_spouse.*', 'pay_periods.name as pay_period_name')
                                            ->leftjoin('pay_periods', 'pay_periods.id', 'employment_spouse.pay_period')
                                            ->where('client_id', $idx)->get(); // Usar $idx
        $lawsuits                       = Lawsuit::where('client_id', $idx)->get(); // Usar $idx
        $bankruptcys                    = Bankruptcy::where('client_id', $idx)->get(); // Usar $idx
        $livedAbroads                   = LivedAbroad::where('client_id', $idx)->get(); // Usar $idx
        $trustees                       = Trustee::where('client_id', $idx)->get(); // Usar $idx
        $safeDepositBoxs                = SafeDepositBox::where('client_id', $idx)->get(); // Usar $idx
        $bankAccounts                   = BankAccount::select('bank_accounts.*', 'bank_account_types.name as bank_type_name')
                                            ->join('bank_account_types','bank_account_types.id','bank_accounts.type_of_account')
                                            ->where('bank_accounts.client_id', $idx)->get(); // Usar $idx
        $investmentAccounts             = InvestmentAccount::select('investment_accounts.*', 'bank_account_types.name as bank_type_name')
                                            ->join('bank_account_types','bank_account_types.id','investment_accounts.type_of_account')
                                            ->where('investment_accounts.client_id', $idx)->get(); // Usar $idx
        $digitalAssets                  = DigitalAsset::where('client_id', $idx)->get(); // Usar $idx
        $creditAccounts                 = CreditAccount::where('client_id', $idx)->get(); // Usar $idx
        $lifeInsurances                 = LifeInsurance::where('client_id', $idx)->get(); // Usar $idx
        $propertys                      = Property::where('client_id', $idx)->get(); // Usar $idx
        $vehicles                       = Vehicle::where('client_id', $idx)->get(); // Usar $idx
        $otherAssets                    = OtherAsset::where('client_id', $idx)->get(); // Usar $idx
        $monthlyFinancials              = MonthlyFinancial::where('client_id', $idx)->get(); // Usar $idx
        $paymentProcessors              = PaymentProcessor::where('client_id', $idx)->get(); // Usar $idx
        $creditCards                    = CreditCard::where('client_id', $idx)->get(); // Usar $idx
        $businessBankAccounts           = BusinessBankAccount::select('business_bank_accounts.*', 'bank_account_types.name as bank_type_name')
                                            ->join('bank_account_types','bank_account_types.id','business_bank_accounts.type_of_account')
                                            ->where('business_bank_accounts.client_id', $idx)->get(); // Usar $idx
        $companyAccountReceivables      = CompanyAccountReceivable::where('client_id', $idx)->get(); // Usar $idx
        $companyDigitalAssets           = CompanyDigitalAsset::where('client_id', $idx)->get(); // Usar $idx
        $companyToolEquipments          = CompanyToolEquipment::where('client_id', $idx)->get(); // Usar $idx
    
        // --- Cálculo (más robusto contra nulls) ---
        $totalLifeInsurance = $lifeInsurances->sum(function($insurance) {
            // Asegurar que los valores sean numéricos, por defecto 0 si son null/inválidos
            $currentCashValue = (float) ($insurance->current_cash_value ?? 0);
            $loanBalance      = (float) ($insurance->outstanding_loan_balance ?? 0);
            return $currentCashValue - $loanBalance;
        });
    
        // 5. Cargar la vista PDF con los datos correctos
        return PDF::loadView('pdf.f433a', [
            'client'                    => $client, // Ahora $client es el correcto o la función abortó antes
            'dependents'                => $dependents,
            'businessInterests'         => $businessInterests,
            'employments'               => $employments,
            'employmentSpouses'         => $employmentSpouses,
            'lawsuits'                  => $lawsuits,
            'bankruptcys'               => $bankruptcys,
            'livedAbroads'              => $livedAbroads,
            'trustees'                  => $trustees,
            'safeDepositBoxs'           => $safeDepositBoxs,
            'bankAccounts'              => $bankAccounts,
            'investmentAccounts'        => $investmentAccounts,
            'digitalAssets'             => $digitalAssets,
            'creditAccounts'            => $creditAccounts,
            'lifeInsurances'            => $lifeInsurances,
            'totalLifeInsurance'        => $totalLifeInsurance,
            'propertys'                 => $propertys,
            'vehicles'                  => $vehicles,
            'otherAssets'               => $otherAssets,
            'monthlyFinancials'         => $monthlyFinancials,
            'paymentProcessors'         => $paymentProcessors,
            'creditCards'               => $creditCards,
            'businessBankAccounts'      => $businessBankAccounts,
            'companyAccountReceivables' => $companyAccountReceivables,
            'companyDigitalAssets'      => $companyDigitalAssets,
            'companyToolEquipments'     => $companyToolEquipments,
            ])
        ->setPaper('letter', 'portrait')
        ->stream('f433a.pdf');
    }
    public function pdf_f433b($id)
    {
        // 1. Autenticación
        if (!Auth::check()) {
            return redirect('/');
        }
    
        // 1.5 Validación del ID
        if (!is_numeric($id)) {
            abort(404, 'Formato de ID de cliente inválido.');
        }
        $idx = (int) $id; // Usar el ID validado y convertido a entero
    
        $user = Auth::user();
    
        // 2. Autorización (Ya estaba bien implementada aquí)
        if ($user->type == 1) {
            // Super admin puede continuar
        }
        elseif ($user->type == 2) {
            $clientBelongsToCompany = Client::where('id', $idx) // Usar $idx
                ->where('company_id', $user->company_id)
                ->exists();
    
            if (!$clientBelongsToCompany) {
                abort(403, 'Acceso no autorizado a los datos del cliente.');
            }
        }
        else { // Asumiendo usuarios tipo 3 u otros necesitan asignación
            $clientAssignedToUser = UserClient::where('client_id', $idx) // Usar $idx
                ->where('user_id', $user->id)
                ->exists();
    
            if (!$clientAssignedToUser) {
                abort(403, 'Acceso no autorizado a los datos del cliente.');
            }
        }
    
        // 3. Obtener datos del Cliente (Usando $idx y leftJoin)
        $client = Client::select(
                'clients.*',
                'states_of_america.abrev as state_abrev',
                'states_of_america.name as state_name',
                'country.name as country_name',
                'business_types.name as business_types_name'
            )
            ->leftJoin('states_of_america', 'states_of_america.id', 'clients.state') // leftJoin por si no tiene estado
            ->leftJoin('country', 'country.id', 'clients.country')                 // leftJoin por si no tiene país
            ->leftJoin('business_types', 'business_types.id', 'clients.type_of_entity') // leftJoin por si no tiene tipo
            ->where('clients.id', $idx) // <-- Filtrar por el ID correcto!
            ->first();
    
        // 4. Manejar si el cliente no se encuentra
        if ($client == null) { // La verificación existente es adecuada
             // Podrías usar abort(404) también: abort(404, 'Cliente no encontrado.');
             return redirect('clients')->with('error', 'Cliente no encontrado.');
        }
    
        // --- Obtener datos relacionados (usando el ID correcto $idx) ---
        $businessTypes              = BusinessType::all(); // Esto no depende del cliente
        $ecommerceProcessors        = EcommerceProcessor::where('client_id', $idx)->get(); // Usar $idx
        $creditCards                = CreditCard::where('client_id', $idx)->get(); // Usar $idx
        $partnerOffices             = PartnerOfficer::where('client_id', $idx)->get(); // Usar $idx
        $statesOfAmerica            = StateOfAmerica::all(); // Esto no depende del cliente
        $payrollServiceProviders    = PayrollServiceProvider::where('client_id', $idx)->get(); // Usar $idx
        $lawsuits                   = Lawsuit::where('client_id', $idx)->get(); // Usar $idx
        $bankruptcies               = Bankruptcy::where('client_id', $idx)->get(); // Usar $idx
        $relatedPartyOweBusiness    = RelatedPartyOweBusiness::where('client_id', $idx)->get(); // Usar $idx
        $businessAssetTransfers     = BusinessAssetTransfer::where('client_id', $idx)->get(); // Usar $idx
        $incomeChanges              = IncomeChange::where('client_id', $idx)->get(); // Usar $idx
        $safes                      = Safe::where('client_id', $idx)->get(); // Usar $idx
        // Nota: Considera si estas relaciones deberían usar tablas específicas para 433B vs 433A si los datos son distintos
        $bankAccounts               = BankAccount::where('client_id', $idx)->get(); // Usar $idx
        $bankAccountTypes           = BankAccountType::all(); // No depende del cliente
        $receivables                = Receivable::where('client_id', $idx)->get(); // Usar $idx
        $investmentAccounts         = InvestmentAccount::where('client_id', $idx)->get(); // Usar $idx
        $creditLines                = CreditLine::where('client_id', $idx)->get(); // Usar $idx
        $propertys                  = Property::where('client_id', $idx)->get(); // Usar $idx
        $vehicles                   = Vehicle::where('client_id', $idx)->get(); // Usar $idx
        $companyToolEquipments      = CompanyToolEquipment::where('client_id', $idx)->get(); // Usar $idx
        $intangibleAssets           = IntangibleAsset::where('client_id', $idx)->get(); // Usar $idx
        $businessLiabilitys         = BusinessLiability::where('client_id', $idx)->get(); // Usar $idx
        $monthlyFinancials          = MonthlyFinancial::where('client_id', $idx)->get(); // Usar $idx
    
        // 5. Cargar la vista PDF con los datos correctos
        return PDF::loadView('pdf.f433b', [
            'client'                    => $client, // Ahora $client es el correcto o la función abortó/redirigió antes
            'businessTypes'             => $businessTypes,
            'ecommerceProcessors'       => $ecommerceProcessors,
            'creditCards'               => $creditCards,
            'partnerOffices'            => $partnerOffices,
            'statesOfAmerica'           => $statesOfAmerica,
            'payrollServiceProviders'   => $payrollServiceProviders,
            'lawsuits'                  => $lawsuits,
            'bankruptcies'              => $bankruptcies,
            'relatedPartyOweBusiness'   => $relatedPartyOweBusiness,
            'businessAssetTransfers'    => $businessAssetTransfers,
            'incomeChanges'             => $incomeChanges,
            'safes'                     => $safes,
            'bankAccounts'              => $bankAccounts,
            'bankAccountTypes'          => $bankAccountTypes,
            'receivables'               => $receivables,
            'investmentAccounts'        => $investmentAccounts,
            'creditLines'               => $creditLines,
            'propertys'                 => $propertys,
            'vehicles'                  => $vehicles,
            'companyToolEquipments'     => $companyToolEquipments,
            'intangibleAssets'          => $intangibleAssets,
            'businessLiabilitys'        => $businessLiabilitys,
            'monthlyFinancials'         => $monthlyFinancials,
            ])
        ->setPaper('letter', 'portrait')
        ->stream('f433b.pdf');
    }
    public function pdf_f433d(Request $request)
    {
        if (empty(auth()->id()))
        {
            return redirect('/');
        }

        return PDF::loadView('pdf.f433d')
        ->setPaper('letter', 'portrait')
        ->stream('f433d.pdf');

    }
    public function pdf_f8821($id)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
    
        // 1.5 Validación del ID
        if (!is_numeric($id)) {
            abort(404, 'Formato de ID de cliente inválido.');
        }
        $idx = (int) $id; // Usar el ID validado y convertido a entero
    
        $user = Auth::user();
    
        // 2. Autorización (Ya estaba bien implementada aquí)
        if ($user->type == 1) {
            // Super admin puede continuar
        }
        elseif ($user->type == 2) {
            $clientBelongsToCompany = Client::where('id', $idx) // Usar $idx
                ->where('company_id', $user->company_id)
                ->exists();
    
            if (!$clientBelongsToCompany) {
                abort(403, 'Acceso no autorizado a los datos del cliente.');
            }
        }
        else { // Asumiendo usuarios tipo 3 u otros necesitan asignación
            $clientAssignedToUser = UserClient::where('client_id', $idx) // Usar $idx
                ->where('user_id', $user->id)
                ->exists();
    
            if (!$clientAssignedToUser) {
                abort(403, 'Acceso no autorizado a los datos del cliente.');
            }
        }
        
        // 3. Obtener datos del Cliente (Usando $idx y leftJoin)
        $client = Client::select(
                'clients.*',
                'states_of_america.abrev as state_abrev',
                'states_of_america.name as state_name',
                'country.name as country_name',
                'business_types.name as business_types_name'
            )
            ->leftJoin('states_of_america', 'states_of_america.id', 'clients.state') // leftJoin por si no tiene estado
            ->leftJoin('country', 'country.id', 'clients.country')                 // leftJoin por si no tiene país
            ->leftJoin('business_types', 'business_types.id', 'clients.type_of_entity') // leftJoin por si no tiene tipo
            ->where('clients.id', $idx) // <-- Filtrar por el ID correcto!
            ->first();

            /*
            'caf_no'                    => 'nullable|string|max:50',
            'ptin'                      => 'nullable|string|max:50',
            */
        $users_asign = Client::select('users.name', 'users.email', 'users.caf_no', 'users.ptin', 'users.address', 'users.telephone', 'poa1_description',
                                    'users.poa1_form_number',
                                    'users.poa1_period',
                                    'users.poa2_description',
                                    'users.poa2_form_number',
                                    'users.poa2_period',
                                    'users.poa3_description','poa3_form_number','poa3_period')
                    ->leftjoin('user_to_client','user_to_client.client_id', 'clients.id')
                    ->leftjoin('users', 'users.id', 'user_to_client.user_id')
                    ->where('clients.id', $idx)
                    ->first();
    
        // 4. Manejar si el cliente no se encuentra
        if ($client == null) { // La verificación existente es adecuada
             // Podrías usar abort(404) también: abort(404, 'Cliente no encontrado.');
             return redirect('clients')->with('error', 'Cliente no encontrado.');
        }
        return view('pdf.f8821', compact('client', 'users_asign'));
        // return PDF::loadView('pdf.f8821_')
        // ->setPaper('letter', 'portrait')
        // ->stream('f8821.pdf');

    }
    public function pdf_f2848($id)
    {
        if (empty(auth()->id()))
        {
            return redirect('/');
        }

        $idx = (int) $id; // Usar el ID validado y convertido a entero
    
        $user = Auth::user();
    
        // 2. Autorización (Ya estaba bien implementada aquí)
        if ($user->type == 1) {
            // Super admin puede continuar
        }
        elseif ($user->type == 2) {
            $clientBelongsToCompany = Client::where('id', $idx) // Usar $idx
                ->where('company_id', $user->company_id)
                ->exists();
    
            if (!$clientBelongsToCompany) {
                abort(403, 'Acceso no autorizado a los datos del cliente.');
            }
        }
        else { // Asumiendo usuarios tipo 3 u otros necesitan asignación
            $clientAssignedToUser = UserClient::where('client_id', $idx) // Usar $idx
                ->where('user_id', $user->id)
                ->exists();
    
            if (!$clientAssignedToUser) {
                abort(403, 'Acceso no autorizado a los datos del cliente.');
            }
        }
        
        // 3. Obtener datos del Cliente (Usando $idx y leftJoin)
        $client = Client::select(
                'clients.*',
                'states_of_america.abrev as state_abrev',
                'states_of_america.name as state_name',
                'country.name as country_name',
                'business_types.name as business_types_name'
            )
            ->leftJoin('states_of_america', 'states_of_america.id', 'clients.state') // leftJoin por si no tiene estado
            ->leftJoin('country', 'country.id', 'clients.country')                 // leftJoin por si no tiene país
            ->leftJoin('business_types', 'business_types.id', 'clients.type_of_entity') // leftJoin por si no tiene tipo
            ->where('clients.id', $idx) // <-- Filtrar por el ID correcto!
            ->first();

            /*
            'caf_no'                    => 'nullable|string|max:50',
            'ptin'                      => 'nullable|string|max:50',
            */
        $users_asign = Client::select('users.name', 'users.email', 'users.caf_no', 'users.ptin', 'users.address', 'users.telephone', 'poa1_description',
                                    'users.poa1_form_number',
                                    'users.poa1_period',
                                    'users.poa2_description',
                                    'users.poa2_form_number',
                                    'users.poa2_period',
                                    'users.poa3_description','poa3_form_number','poa3_period',
                                    'designation',
                                    'licensing_jurisdiction',
                                    'license_no',
                                    'ptin'
                                )
                    ->leftjoin('user_to_client','user_to_client.client_id', 'clients.id')
                    ->leftjoin('users', 'users.id', 'user_to_client.user_id')
                    ->where('clients.id', $idx)
                    ->first();

        return view('pdf.f2848',compact('client', 'users_asign'));
        // return PDF::loadView('pdf.f2848')
        // ->setPaper('letter', 'portrait')
        // ->stream('f2848.pdf');

    }
    public function save(ClientRequest $request)
    {
        if (!Auth::check()) {
            // Para API, mejor un JSON response
            return response()->json(['status' => false, 'msg' => 'Unauthenticated.', 'type' => 'error'], 401);
        }

        $user = Auth::user();
        // Authorization (Only superadmin, admin and user can create clients)
        if (!in_array($user->type, [1, 2, 3])) {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access to create client.',
                'type'   => 'error'
            ], 403);
        }

        try {
            if (!$request->ajax()) {
                return response()->json([
                    'status'    => false,
                    'msg'       => 'Invalid request. AJAX expected.',
                    'type'      => 'warning'
                ], 400);
            }

            $validatedData = $request->validated();

            $clientData = array_merge($validatedData, [
                'estatus'       => 1,
                'avatar'        => $validatedData['avatar'] ?? 1, // Usar valor del request si existe, sino default
                'case_status'   => $validatedData['case_status'] ?? 1,
                'company_id'    => Auth::user()->company_id,
                // 'slug' and 'storage_path' will be set after creation
            ]);

            // Remover campos que no existen en la tabla 'clients' si vienen de $validatedData y no son necesarios aquí
            // unset($clientData['avatar'], $clientData['case_status']); // si no son parte directa de clients table al crear

            $client = Client::create($clientData);

            // Generar y guardar el path de almacenamiento
            $clientStorageFolderName = 'client_' . $client->id;
            $clientRelativeStoragePath = self::CLIENT_PRIVATE_BASE_PATH . '/' . $clientStorageFolderName;
            $client->storage_path = $clientRelativeStoragePath;

            // Generar SLUG único
            if (empty($client->slug)) { // Podría ser generado por un observer/mutator también
                 $slugBase = !empty($client->business_name) ? $client->business_name : ($client->first_name . ' ' . $client->last_name);
                 $uniqueSuffix = Str::random(4); // Añadir aleatoriedad para unicidad
                 $client->slug = Str::slug($slugBase . '-' . $client->id . '-' . $uniqueSuffix);
            }
            $client->save(); // Guardar slug y storage_path

            $this->createClientDirectoryStructure($client);
            $this->generateDifferentModules($client);

            if (Auth::user()->type == 3) { // Asignar automáticamente al usuario creador si es tipo 3
                UserClient::create([
                    'client_id' => $client->id,
                    'user_id'   => Auth::user()->id
                ]);
            }

            // Lógica de notificación (descomentar y ajustar si es necesario)
            /*
            $userGuest  = User::infoClient(Auth::user()->id); // Asumo que esto es User::find(Auth::user()->id);
            $userAdmin  = User::getUserAdminByCompany($userGuest->company_id);
            if ($userAdmin && isset($userAdmin[0])) {
                // send_notification($userAdmin[0]->id, 'New Client', $userGuest->name.' has created a new client.', 'clients', '👤➕', 'info');
            }
            */

            return response()->json([
                'status'    => true,
                'msg'       => 'Successfully registered client and created directories.',
                'type'      => 'success',
                'title'     =>'Perfect!'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false, 'msg' => 'Validation failed.', 'errors' => $e->errors(), 'type' => 'validation_error'
            ], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error("DB Error saving client: " . $e->getMessage() . "\nSQL: " . $e->getSql() . "\nBindings: " . implode(", ", $e->getBindings()));
            return response()->json(['status' => false, 'msg' => 'Database error while registering client. Please try again.', 'type' => 'error', 'error_detail' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            \Log::error("Error in save client: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());
            return response()->json(['status' => false, 'msg' => 'An error occurred while registering the client. Please try again.', 'type' => 'error', 'error_detail' => $e->getMessage()], 500);
        }
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
    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        
        $user = Auth::user();
        // Authorization (Only superadmin, admin and user can edit clients)
        if (!in_array($user->type, [1, 2, 3])) {
            return response()->json([
            'status' => false,
            'msg'    => 'Unauthorized access.',
            'type'   => 'error'
            ]);
        }

        // 1.5 Validación del ID
        if (!is_numeric($id)) {
            abort(404, 'Formato de ID de cliente inválido.');
        }
        $idx = (int) $id; // Usar el ID validado y convertido a entero

        // Check if the user is super admin
        if ($user->type == 1) {
            // Super admin can continue
        } 
        // Check if the user is admin and the client belongs to their company
        elseif ($user->type == 2) {
            $clientBelongsToCompany = Client::where('id', $idx)
                ->where('company_id', $user->company_id)
                ->exists();

            if (!$clientBelongsToCompany) {
                abort(403, 'Unauthorized access to client data.');
            }
        } 
        // Check if the user is assigned to the client
        else {
            $clientAssignedToUser = UserClient::where('client_id', $idx)
                ->where('user_id', $user->id)
                ->exists();

            if (!$clientAssignedToUser) {
                abort(403, 'Unauthorized access to client data.');
            }
        }





        $client = Client::find($id);

        return response()->json([
            'status'    => true,
            'msg'       => 'get Info',
            'type'      => 'success',
            'data'      => $client
        ]);

    }
    public function update(UpdateClientRequest $request, $id)
    {
        
        if (!Auth::check()) {
            return redirect('/');
        }

        if (!is_numeric($id)) {
            abort(404, 'Invalid User ID format.');
        }

        
        if (!$request->ajax()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'Intente de nuevo',
                'type'      => 'warning'
            ]);
        }

        $idx = (int) $id; 
        
        $user = Auth::user();

        // Check if the user is super admin
        if ($user->type == 1) {
            // Super admin can continue
        } 
        // Check if the user is admin and the client belongs to their company
        elseif ($user->type == 2) {
            $clientBelongsToCompany = Client::where('id', $idx)
                ->where('company_id', $user->company_id)
                ->exists();

            if (!$clientBelongsToCompany) {
                abort(403, 'Unauthorized access to client data.');
            }
        } 
        // Check if the user is assigned to the client
        else {
            $clientAssignedToUser = UserClient::where('client_id', $idx)
                ->where('user_id', $user->id)
                ->exists();

            if (!$clientAssignedToUser) {
                abort(403, 'Unauthorized access to client data.');
            }
        }



        $client = Client::find($idx);
    
        if (!$client) {
            return response()->json(['status' => false, 'msg' => 'Cliente no encontrado'], 404);
        }



        $validatedData = $request->validated();

            $client->first_name                    = $request->input('first_name');
            $client->mi                            = $request->input('mi');
            $client->form_type                     = $request->input('form_type');
            $client->last_name                     = $request->input('last_name');
            $client->ssn                           = $request->input('ssn');
            $client->date_birdth                   = $request->input('date_birth');
            $client->dl                            = $request->input('dl');
            $client->dl_state                      = $request->input('dl_state');
            $client->has_passport                  = $request->input('has_passport');
            $client->client_reference              = $request->input('client_reference');
            $client->saludation_for_letter         = $request->input('saludation_for_letter');
            $client->type_address                  = $request->input('type_address');
            $client->address_1                     = $request->input('address_1');
            $client->address_2                     = $request->input('address_2');
            $client->city                          = $request->input('city');
            $client->state                         = $request->input('state');
            $client->zipcode                       = $request->input('zipcode');
            $client->country                       = $request->input('country');
            $client->m_address_1                   = $request->input('m_address_1');
            $client->m_address_2                   = $request->input('m_address_2');
            $client->m_city                        = $request->input('m_city');
            $client->m_state                       = $request->input('m_state');
            $client->m_zipcode                     = $request->input('m_zipcode');
            $client->marital_status                = $request->input('marital_status');
            $client->marital_date                  = $request->input('marital_date');
            $client->spouse_first_name             = $request->input('spouse_first_name');
            $client->spouse_mi                     = $request->input('spouse_mi');
            $client->spouse_last_name              = $request->input('spouse_last_name');
            $client->spouse_ssn                    = $request->input('spouse_ssn');
            $client->spouse_date_birdth            = $request->input('spouse_date_birdth');
            $client->spouse_dl                     = $request->input('spouse_dl');

            $client->spouse_dl_state               = $request->input('spouse_dl_state');
            $client->spouse_has_passport           = $request->input('spouse_has_passport');
            $client->spouse_saludation_for_letter  = $request->input('spouse_saludation_for_letter');
            $client->phone_home                    = $request->input('phone_home');
            $client->cell_home                     = $request->input('cell_home');
            $client->fax_home                      = $request->input('fax_home');
            $client->phone_work                    = $request->input('phone_work');
            $client->cell_work                     = $request->input('cell_work');
            $client->fax_work                      = $request->input('preferred');
            $client->spouse_phone_home             = $request->input('spouse_phone_home');
            $client->spouse_cell_home              = $request->input('spouse_cell_home');
            $client->spouse_fax_home               = $request->input('spouse_fax_home');
            $client->spouse_phone_work             = $request->input('spouse_phone_work');
            $client->spouse_cell_work              = $request->input('spouse_cell_work');
            $client->spouse_fax_work               = $request->input('spouse_preferred');
            $client->tax_payer_email               = $request->input('tax_payer_email');
            $client->spouse_email                  = $request->input('spouse_email');
            // $client->estatus                       = 1;
            $client->tags                          = $request->input('tags');
            $client->monitor                       = $request->input('monitor');
            $client->type                          = $request->input('type');
            // $client->avatar                        = 1;
            // $client->case_status                   = 1;
            // $client->company_id                    = Auth::user()->company_id;
            $client->save();

        if (Auth::user()->type == 3)
        {
            UserClient::create([
                'client_id' => $id,
                'user_id'   => Auth::user()->id
            ]);
        }

        $userGuest  = User::infoClient(Auth::user()->id);
        $userAdmin  = User::getUserAdminByCompany($userGuest->company_id);
        if (!empty($userAdmin))
        {
            send_notification($userAdmin[0]->id, 'Update  Client', $userGuest->name.' has updated a new client.', 'clients', '👤✏️', 'info');
        }



        return response()->json([
                'status'    => true,
                'msg'       => 'Successfully registered client',
                'type'      => 'success',
                'title'     =>'Perfect!'
            ]);
    }
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();

        // Check if the user is super admin
        if ($user->type == 1) {
            // Super admin can delete any client
            $client = Client::find($id);
        } 
        // Check if the user is admin and the client belongs to their company
        elseif ($user->type == 2) {
            $client = Client::where('id', $id)
                ->where('company_id', $user->company_id)
                ->first();

            if (!$client) {
                return response()->json([
                    'status' => false,
                    'msg'    => 'Unauthorized access or client not found.',
                    'type'   => 'error'
                ]);
            }
        } 
        // Other user types are not allowed to delete clients
        else {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access.',
                'type'   => 'error'
            ]);
        }

        if ($client) {
            $client->estatus = 0; // Soft delete by updating the status
            $client->save();

            return response()->json([
                'status' => true,
                'msg'    => 'Client successfully soft deleted.',
                'type'   => 'success'
            ]);
        }

        return response()->json([
            'status' => false,
            'msg'    => 'Client not found.',
            'type'   => 'error'
        ]);
    }
    public function clients_json()
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();


        if (Auth::user()->type == 1)
        {
            $lista = Client::select(
                DB::raw("CONCAT(first_name,' ',last_name) AS full_name"), 
                DB::raw("CONCAT(spouse_first_name,' ',spouse_last_name) AS spouse"), 
                DB::raw("CONCAT(client_reference) AS reference"), 
                "clients.id", 'phone_home', 'clients.slug', 'cell_home', 'clients.city', 'clients.address_1', 'estatus as status' ,'avatar.image as avatar', 'case_status','clients.form_type','business_name','tax_payer_email')
                ->join('avatar','avatar.id', 'clients.avatar')
                ->orderby('clients.updated_at', 'desc')
                ->get();
        } 
        else
        {
            if (Auth::user()->type == 2)
            {
                $lista = Client::select(
                    DB::raw("CONCAT(first_name,' ',last_name) AS full_name"), 
                    DB::raw("CONCAT(spouse_first_name,' ',spouse_last_name) AS spouse"), 
                    DB::raw("CONCAT(client_reference) AS reference"), 
                    "clients.id", 'phone_home', 'clients.slug', 'cell_home', 'clients.city', 'clients.address_1', 'estatus as status','avatar.image as avatar', 'case_status','clients.form_type','business_name','tax_payer_email')
                    ->join('avatar','avatar.id', 'clients.avatar')
                    ->where('company_id', Auth::user()->company_id)
                    ->orderby('clients.updated_at', 'desc')
                    ->get();
            } else
            {
                $lista = Client::select(
                    DB::raw("CONCAT(first_name,' ',last_name) AS full_name"), 
                    DB::raw("CONCAT(spouse_first_name,' ',spouse_last_name) AS spouse"), 
                    DB::raw("CONCAT(client_reference) AS reference"), 
                    "clients.id", 'phone_home', 'clients.slug', 'cell_home', 'clients.city', 'clients.address_1', 'estatus as status','avatar.image as avatar', 'case_status','clients.form_type','business_name','tax_payer_email')
                    // ->leftjoin('user_to_client','user_to_client.client_id', 'clients.id')
                    ->join('avatar','avatar.id', 'clients.avatar')
                    ->where('company_id', Auth::user()->company_id)
                    // ->where('user_to_client.user_id', Auth::user()->id)
                    ->orderby('clients.updated_at', 'desc')
                    ->get();
            }


        }


        return Datatables()
            ->of($lista)
            ->addColumn('full_name', function ($clients) {
                $id         = $clients->id;
                $stateNum   = mt_rand(0, 6);
                // Lista de estados de Bootstrap
                $states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                // Obtener el estado correspondiente
                $state = $states[$stateNum];
                // Simular el nombre completo (esto debe venir de tu base de datos o entrada)
                $name = $clients->full_name;
                $post = $clients->address_1;
                // $slug = $clients->slug;
                // Obtener las iniciales del nombre
                preg_match_all('/\b\w/', $name, $matches);
                $initials = strtoupper(implode('', array($matches[0][0] ?? '', end($matches[0]) ?? '')));


                    $hash = rawurlencode($clients->encrypted_slug);
                    // echo "hash: ".$hash.'<br>';
                    // $link  = route('clients.detail', ['hash' => $hash]);

                    // echo $link;


                    $link = route('clients.detail', $hash);
                    // $link = '';
                // Generar la salida HTML
                $output     = '<span class="avatar-initial rounded-circle bg-label-' . $state . '">' . $initials . '</span>';
                $row_output = '<div class="d-flex justify-content-start align-items-center user-name detail-href profile-item-userx" data-idx="'.$id.'" >
                                <div class="d-flex flex-column">
                                <a href="'.$link.'">
                                <span class="emp_name text-truncate text-heading fw-medium">
                                '.$name .'
                                </span>
                                </a>
                                <small class="emp_post text-truncate">
                                '.$post .'
                                </small>
                                </div>
                                </div>';

                return $row_output;
            })
            ->addColumn('actions', function ($clients) {
                $id = $clients->id;
                return '
                    <div class="d-inline-block">
                        <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ri-more-2-line"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end m-0">
                            <li><a href="javascript:;" class="dropdown-item profile-item-user" data-bs-toggle="modal" data-bs-target="#profileUser" data-idx="' . $id . '">Profile</a></li>
                            <li><a href="clients/pdf_f433d" target="_new" class="dropdown-item"><i class="ri-file-pdf-line"></i> f433d.pdf</a></li>
                            <!-- <div class="dropdown-divider"></div> -->
                            <!-- <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li> -->
                        </ul>
                    </div>
                    <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit edit-client" data-idx="'.$id.'">
                        <i class="ri-edit-box-line"></i>
                    </a>
                ';
            })

            ->addColumn('phone', function ($clients) {
                $phone_home = $clients->phone_home;
                $cell_home  = $clients->cell_home;
                return '<div class=" align-items-center ">
                            <p class="emp_post text-truncate"><a href="tel:'.$phone_home.'">'.$phone_home.'</a></p>
                            <p class="emp_post text-truncate"><a href="tel:'.$cell_home.'">'.$cell_home.'</a></p>
                        </div>';
            })

            ->addColumn('company_name', function($clients){
                if ($clients->business_name == null)
                {
                    return $clients->full_name;
                }
                return $clients->business_name;
            })
            ->addColumn('form_type', function($clients){
                $style = '';
                switch ($clients->form_type) {
                    case '433A':
                        $style = 'btn-outline-success';
                    break;

                    case '433B':
                        $style = 'btn-outline-primary';
                    break;

                    case '433A OIC':
                        $style = 'btn-outline-warning';
                    break;

                    case '433B OIC':
                        $style = 'btn-outline-info';
                    break;
                }

                $button ='<button type="button" class="btn btn-sm '.$style.' dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
                        '.$clients->form_type.'
                      </button>';
                $button .= '<ul class="dropdown-menu">
                        <li><a class="dropdown-item waves-effect change-form-type" data-type="433A" data-idx="'.$clients->id.'" href="javascript:void(0);" >433A</a></li>
                        <li><a class="dropdown-item waves-effect change-form-type" data-type="433B" data-idx="'.$clients->id.'" href="javascript:void(0);" >433B</a></li>
                        <li><a class="dropdown-item waves-effect change-form-type" data-type="433A OIC" data-idx="'.$clients->id.'" href="javascript:void(0);" >433A OIC</a></li>
                        <li><a class="dropdown-item waves-effect change-form-type" data-type="433B OIC" data-idx="'.$clients->id.'" href="javascript:void(0);" >433B OIC</a></li>
                      </ul>';



                return $button;
            })
            
            ->editColumn('case_status', function ($clients) {
                
                $case_status    = $clients->case_status;
                $case_name      = '';
                $status = [
                    1 => ['title' => 'Open', 'class' => 'bg-label-success'],
                    2 => ['title' => 'In Progress', 'class' => 'bg-label-warning'],
                    3 => ['title' => 'Closed', 'class' => 'bg-label-primary'],
                ];
            
                $style = '';
                switch ($case_status) {
                    case '1':
                        $style      = 'btn-outline-success';
                        $case_name  = 'Open';
                    break;

                    case '2':
                        $style = 'btn-outline-warning';
                        $case_name  = 'In Progress';
                    break;

                    case '3':
                        $style = 'btn-outline-primary';
                        $case_name  = 'Closed';
                    break;
                }

                $button ='<button type="button" class="btn btn-sm '.$style.' dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
                        '.$case_name.'
                      </button>';

                $button .= '<ul class="dropdown-menu">
                        <li><a class="dropdown-item waves-effect change-case-status" data-case="1" data-idx="'.$clients->id.'" href="javascript:void(0);" >Open</a></li>
                        <li><a class="dropdown-item waves-effect change-case-status" data-case="2" data-idx="'.$clients->id.'" href="javascript:void(0);" >In Progress</a></li>
                        <li><a class="dropdown-item waves-effect change-case-status" data-case="3" data-idx="'.$clients->id.'" href="javascript:void(0);" >Closed OIC</a></li>
                      </ul>';



                return $button;




            })
            ->addColumn('services_offered', function ($clients) {

                $ClientService = ClientService::select('company_services.service_name')
                                ->join('company_services', 'company_services.id', 'client_services.service_id')
                                ->where('client_services.client_id', $clients->id)
                                ->get();

                $list = '';
                if (count($ClientService) == 0)
                {
                    $list .= '<span data-idx="'.$clients->id.'" class="badge bg-label-primary mb-1 mr-1 btn-modal-services" data-bs-toggle="modal" data-bs-target="#catalog-service">- -</span>';
                }
                foreach ($ClientService as $service)
                {
                    $list .= '<span data-idx="'.$clients->id.'" class="badge bg-label-primary mb-1 mr-1 btn-modal-services" data-bs-toggle="modal" data-bs-target="#catalog-service">'.$service->service_name.'</span>';
                }
                return $list;
            })

            ->editColumn('tax_payer_email', function ($clients) {
                return '<a href="mailto:'.$clients->tax_payer_email.'">'.$clients->tax_payer_email.'</a>';
            })
            ->editColumn('status', function ($clients) {
                
                $status_number = $clients->status;

                $status = [
                    1 => ['title' => 'Active', 'class' => 'bg-label-success'],
                    2 => ['title' => 'Closed', 'class' => 'bg-label-primary'],
                    3 => ['title' => 'Pending', 'class' => 'bg-label-warning'],
                    // 4 => ['title' => 'Resigned', 'class' => 'bg-label-warning'],
                    // 5 => ['title' => 'Applied', 'class' => 'bg-label-info']
                ];
            
                // Verificar si el estado existe en el array, si no, devolver $data
                if (!isset($status[$status_number])) {
                    return '';
                }
            
                // Construir el HTML con la etiqueta de estado
                return '<span class="badge ' . $status[$status_number]['class'] . '">' . $status[$status_number]['title'] . '</span>';
                

            })
            ->addColumn('asign_to', function($client){
                $user_clients = $client->userClients()
                    ->select('users.id', 'users.name')
                    ->get();

                $user_clientsTotal = $user_clients->count();
                $asign_all = '';
                foreach ($user_clients as $user_client)
                {   

                    $cliente_name = strlen($user_client->name) > 14 ? substr($user_client->name, 0, 14) . '...' : $user_client->name;






                    $name       = $cliente_name ?? 'Sin asignar';
                    $user_id    = $user_client?->id ?? '';

                    // Elegir clase del badge según el valor
                    $badgeClass = ($name === 'Sin asignar') ? 'bg-label-danger' : 'bg-label-primary';

                    $asign_all .= '<div class="text-center mt-1" style="width: 120px;">
                                <span data-client="'.$client->id.'"  data-user="'.$user_id.'" data-bs-toggle="modal" data-bs-target="#modal-user-to-client"    class="btn-modal-asign-user-to-client badge '.$badgeClass.'  show-user-asign-client" title="'.$user_client->name.'">'.$name.'</span>
                            </div>';
                    # code...
                }

            if ($user_clientsTotal == 0)
            {
                return '<div class="text-center" style="width: 120px;">
                                    <span data-client="'.$client->id.'"  data-user="" data-bs-toggle="modal" data-bs-target="#modal-user-to-client"    class="btn-modal-asign-user-to-client badge bg-label-danger">Sin asignar</span>
                                </div>';
            } else
            {
                return $asign_all;

            }


            })
            ->addIndexColumn()
            // ->rawColumns(['full_name', 'type', 'actions','status'])
            ->rawColumns(['company_name', 'full_name', 'status',  'case_status', 'actions','phone', 'form_type','tax_payer_email', 'city', 'services_offered','asign_to'])
            // ->toJson();
            ->make(true);
    }
    public function info_asign($client_id)
    {
        if (!Auth::check()) {
            return redirect('/');
        }


        $list = UserClient::select('user_id')->where('client_id', $client_id)->get();

        return response()->json([
                'status'    => true,
                'msg'       => 'Perfect',
                'type'      => 'success',
                'list'      => $list
            ]);
    }
    public function asigment_to_user(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();
        // Authorization (Only superadmin and admin can assign clients to users)
        if (!in_array($user->type, [1, 2])) {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access.',
                'type'   => 'error'
            ]);
        }

        $clientId = $request->input('client');
        $userId = $request->input('user');

        // Check if the user is super admin
        if ($user->type == 1) {
            // Super admin can assign any client to any user
        } 
        // Check if the user is admin and the client and user belong to their company
        elseif ($user->type == 2) {
            $clientBelongsToCompany = Client::where('id', $clientId)
                ->where('company_id', $user->company_id)
                ->exists();

            $userBelongsToCompany = User::where('id', $userId)
                ->where('company_id', $user->company_id)
                ->exists();

            if (!$clientBelongsToCompany || !$userBelongsToCompany) {
                return response()->json([
                    'status' => false,
                    'msg'    => 'Unauthorized access. Client or user does not belong to your company.',
                    'type'   => 'error'
                ]);
            }
        }

        // Remove existing assignments for the client

        $clientId = $request->input('client_idxt');
        $userIds = $request->input('user_idxt'); // Puede ser un array
        UserClient::where('client_id', $clientId)->delete();

        foreach ($userIds as $userId) {
            UserClient::create([
                'client_id' => $clientId,
                'user_id'   => $userId
            ]);
        }

        return response()->json([
            'status'    => true,
            'msg'       => 'Successful user to client assignment',
            'type'      => 'success',
            'title'     => 'Perfect!'
        ]);
    }
    public function info(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        $id = (int) $request->id;
        $user = Auth::user();
        if ($user->type == 1) {
            // Super admin can access any client
        } elseif ($user->type == 2) {
            // Admin can access clients only from their company
            $clientBelongsToCompany = Client::where('id', $id)
                ->where('company_id', $user->company_id)
                ->exists();

            if (!$clientBelongsToCompany) {
                abort(403, 'Unauthorized access to client data.');
            }
        } else {
            // Other users can access only assigned clients
            $clientAssignedToUser = UserClient::where('client_id', $id)
                ->where('user_id', $user->id)
                ->exists();

            if (!$clientAssignedToUser) {
                abort(403, 'Unauthorized access to client data.');
            }
        }

        
        $client         = Client::select('clients.*', 'country.flag')->leftjoin('country', 'country.id', 'clients.country')
                            ->where('clients.id', $id)->first();

        $activities = Activities::select('activities.*', 'users.name as user_name' , 'avatar.image', 'type_user.name as type_user')
                            ->join('users', 'users.id', 'activities.user_id')
                            ->join('avatar', 'avatar.id', 'users.avatar')
                            ->join('type_user', 'type_user.id', 'users.type')
                            ->where('client_id', $id)
                            ->orderby('activities.id','desc')
                            ->limit(10)
                            ->get();
        $activitiesTotal = $activities->count();




        $notes      = Notes::select('description','notes.created_at', 'users.name as user_name' , 'avatar.image')
                        ->join('users', 'users.id', 'notes.user_id')
                        ->join('avatar', 'avatar.id', 'users.avatar')
                        ->where('client_id', $id)
                        ->orderby('notes.id','desc')
                        ->limit(10)
                        ->get();
        $notesTotal = $notes->count();


        $files      = Files::select('url','files.created_at', 'users.name as user_name' , 'avatar.image','files.ext')
                        ->join('users', 'users.id', 'files.user_id')
                        ->join('avatar', 'avatar.id', 'users.avatar')
                        ->where('client_id', $id)
                        ->orderby('files.id','desc')
                        ->limit(10)
                        ->get();
        $filesTotal = $files->count();

        $logActivity = ClientActivityLog::join('users', 'users.id', 'client_activity_logs.user_id')
                        ->select('action', 'description', 'client_activity_logs.created_at', 'users.name')->where('client_id', $id)
                        ->orderby('client_activity_logs.id','desc')
                        ->limit(10)
                        ->get();
        $logTotal = $logActivity->count();



        $activitiesArr      = [];
        if ($activitiesTotal > 0)
        {
            foreach ($activities as $item)
            {
                $new_date   = (\Carbon\Carbon::parse($item->date.' '.$item->time)->locale('en_US'))->isoFormat('LLL');


                $diff = \Carbon\Carbon::parse($item->created_at)->locale('en_US')->diffForHumans();


                $itemLista  = '<li class="timeline-item timeline-item-transparent">
                                  <span class="timeline-point timeline-point-success"></span>
                                  <div class="timeline-event">
                                    <div class="timeline-header mb-3">
                                      <h6 class="mb-0">'.strip_tags($item->title).'</h6>
                                      <small class="text-muted">'.$diff.'</small>
                                    </div>
                                    <p class="mb-2">Schedule: '.$new_date.' </p>
                                    <div class="d-flex justify-content-between flex-wrap gap-2 mb-1_5">
                                      <div class="d-flex flex-wrap align-items-center">
                                        <div class="avatar avatar-sm me-2">
                                          <img src="../../assets/img/avatars/'.$item->image.'" alt="Avatar" class="rounded-circle">
                                        </div>
                                        <div>
                                          <p class="mb-0 small fw-medium">Asigment to: '.$item->user_name.'</p>
                                          <small>'.$item->type_user.'</small>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>';
                array_push($activitiesArr, $itemLista);
            }
        }

        $notesArr = [];
        if ($notesTotal >0)
        {
            foreach ($notes as $note)
            {
                $new_date   = (\Carbon\Carbon::parse($note->created_at)->locale('en_US'))->isoFormat('LLL');
                $note_description = strip_tags($note->description);
                $note_description = preg_replace_callback(
                        '/@(\w+)/',
                        fn($m) => '<span class="mention">@' . $m[1] . '</span>',
                        e($note->description)
                    );


                $itemNote = '<div class="note-item"> <p>'.$note_description.'</p> <small>'.$note->user_name.' - '.$new_date.'</small>
                              </div>';
                array_push($notesArr, $itemNote);
            }

        }

        $filesArr = [];
        if ($filesTotal >0)
        {
            foreach ($files as $file)
            {
                $ext = 'pdf';
                switch ($file->ext)
                {
                    case 'pdf':
                        $ext = 'pdf';
                        break;

                    case 'xlsx':
                        $ext = 'xls';
                        break;

                    case 'xls':
                        $ext = 'xls';
                        break;

                    case 'doc':
                        $ext = 'doc';
                        break;

                    case 'docx':
                        $ext = 'doc';
                        break;

                    case 'pptx':
                        $ext = 'ppt';
                        break;

                    case 'ppt':
                        $ext = 'ppt';
                        break;

                    case 'zip':
                        $ext = 'zip';
                        break;
                    case 'rar':
                        $ext = 'zip';
                        break;

                    case 'jpg':
                        $ext = 'jpg';
                        break;
                    case 'jpeg':
                        $ext = 'jpg';
                        break;

                    case 'png':
                        $ext = 'jpg';
                        break;
                }

                $url = url('uploads/'.$file->url);
                $new_date   = (\Carbon\Carbon::parse($file->created_at)->locale('en_US'))->isoFormat('LLL');
                $itemFile = '<li class="timeline-item timeline-item-success">
                              <span class="timeline-point timeline-point-success"></span>
                              <div class="timeline-event">
                                <div class="timeline-header mb-3">
                                  <h6 class="mb-0">Upload by <small>'.$file->user_name.'</small></h6>
                                  <small class="text-muted">'.$new_date.'</small>
                                </div>
                                <div class="d-flex align-items-center mb-1">
                                  <div class="badge bg-lighter rounded-3 mb-1_5">
                                    <img src="../../assets//img/icons/misc/'.$ext.'.png" alt="img" width="15" class="me-2">
                                    <span class="h6 mb-0 text-secondary"><a href="'.$url.'" target="_new">'.$file->url.'</a></span>
                                  </div>
                                </div>
                              </div>
                            </li>';
                array_push($filesArr, $itemFile);
            }

        }

        $activityLogArr = [];
        if ($logTotal > 0)
        {
            foreach ($logActivity as $log)
            {
                $new_date   = (\Carbon\Carbon::parse($log->created_at)->locale('en_US'))->isoFormat('LLL');
                $itemLog = '<li class="timeline-item timeline-item-success">
                              <span class="timeline-point timeline-point-success"></span>
                              <div class="timeline-event">
                                <div class="timeline-header mb-3">
                                  <h6 class="mb-0">'.$log->action.' by <small>'.$log->name.'</small></h6>
                                  <small class="text-muted">'.$new_date.'</small>
                                </div>
                                <div class="d-flex align-items-center mb-1">
                                  <p class="mb-2">'.$log->description.'</p>
                                </div>
                              </div>
                            </li>';
                array_push($activityLogArr, $itemLog);
            }
        }

        $data['info']           = $client;
        $data['activities']     = $activitiesArr;
        $data['notes']          = $notesArr;
        $data['files']          = $filesArr;
        $data['activityLog']    = $activityLogArr;



        return response()->json([
                'status'    => true,
                'msg'       => 'Perfect',
                'type'      => 'success',
                'data'      => $data
            ]);

    }
    public function activities_post(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();
        $clientId = $request->input('client_id');

        // Check if the user is super admin
        if ($user->type == 1) {
            // Super admin can continue
        } 
        // Check if the user is admin and the client belongs to their company
        elseif ($user->type == 2) {
            $clientBelongsToCompany = Client::where('id', $clientId)
            ->where('company_id', $user->company_id)
            ->exists();

            if (!$clientBelongsToCompany) {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access to client data.',
                'type'   => 'error'
            ]);
            }
        } 
        // Check if the user is assigned to the client
        elseif ($user->type == 3) {
            $clientAssignedToUser = UserClient::where('client_id', $clientId)
            ->where('user_id', $user->id)
            ->exists();

            if (!$clientAssignedToUser) {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access to client data.',
                'type'   => 'error'
            ]);
            }
        } 
        // Other user types are not allowed
        else {
            return response()->json([
            'status' => false,
            'msg'    => 'Unauthorized access.',
            'type'   => 'error'
            ]);
        }
        $validator = \Validator::make($request->all(), [
            'deal'      => 'required|string',
            'title'     => 'required|string',
            'type'      => 'required|string',
            'notes'     => 'required|string',
            'date'      => 'required|date',
            'time'      => 'required|date_format:H:i',
            'duration'  => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
            'status' => false,
            'msg'    => $validator->errors()->first(),
            'type'   => 'warning'
            ]);
        }

        $infoClient         = Client::find($request->input('client_id'));
        $fullNameClient     = $infoClient->first_name.' '.$infoClient->last_name;
        // echo '<pre>';
        // print($infoClient);
        // echo '</pre>';
        // exit();
        Activities::create([
            'deal'                 => $request->input('deal'),
            'title'                => $request->input('title'),
            'type'                 => $request->input('type'),
            'notes'                => $request->input('notes'),
            'date'                 => $request->input('date'),
            'time'                 => $request->input('time'),
            'duration'             => $request->input('duration'),
            'client_id'            => $request->input('client_id'),
            'user_id'              => Auth::user()->id,


        ]);

        



        $userGuest  = User::infoClient(Auth::user()->id);
        $userAdmin  = User::getUserAdminByCompany($userGuest->company_id);

        if (empty($userAdmin))
        {
            $userAdmin  = User::getUserAdminByCompanyGeneral();            
        }
        send_notification($userAdmin[0]->id, 'New  Activity', $userGuest->name.' has created a new activiy for '.$fullNameClient, 'calendar', '🗓️', 'info');

        return response()->json([
                'status'    => true,
                'msg'       => 'Successfully registered Activity',
                'type'      => 'success',
                'title'     =>'Perfect!'
            ]);
    }
    public function notes_post(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();
        $clientId = $request->input('client_id');

        // Check if the user is super admin
        if ($user->type == 1) {
            // Super admin can continue
        } 
        // Check if the user is admin and the client belongs to their company
        elseif ($user->type == 2) {
            $clientBelongsToCompany = Client::where('id', $clientId)
                ->where('company_id', $user->company_id)
                ->exists();

            if (!$clientBelongsToCompany) {
                return response()->json([
                    'status' => false,
                    'msg'    => 'Unauthorized access to client data.',
                    'type'   => 'error'
                ]);
            }
        } 
        // Check if the user is assigned to the client
        elseif ($user->type == 3) {
            $clientAssignedToUser = UserClient::where('client_id', $clientId)
                ->where('user_id', $user->id)
                ->exists();

            if (!$clientAssignedToUser) {
                return response()->json([
                    'status' => false,
                    'msg'    => 'Unauthorized access to client data.',
                    'type'   => 'error'
                ]);
            }
        } 
        // Other user types are not allowed
        else {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access.',
                'type'   => 'error'
            ]);
        }

        if (!$request->ajax()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'Intente de nuevo',
                'type'      => 'warning'
            ]);
        }

        if (empty($request->note)) {
            return response()->json([
                'status'    => false,
                'msg'       => 'The field note is required',
                'type'      => 'warning'
            ]);
        }

        Notes::create([
            'description'   => $request->input('note'),
            'client_id'     => $clientId,
            'user_id'       => Auth::user()->id,
        ]);



        // Encuentra todos los @menciones (como @clarence, @maria)
        preg_match_all('/@(\w+)/', $request->input('note'), $matches);

        $slugs                  = $matches[1] ?? []; // ['clarence', 'maria', ''etc]
        $usuariosMencionados    = User::select('id','name')->whereIn('name', $slugs)->get();
        $userGuest              = User::infoClient(Auth::user()->id);

        foreach ($usuariosMencionados as $usuario) {
            // Relacionarlo, notificarlo, guardarlo en tabla pivote, etc.
        send_notification($usuario->id, 'Mentions', $userGuest->name.' mentioned you in a note.', 'Notes', '📝', 'info');
        }
        
        log_client_activity($clientId, 'Created', 'Has created a note');


        $info       = Client::find($clientId);
        $infoUser   = User::find(Auth::user()->id);



        $this->enviarCorreo($info, $infoUser, 'has created a note');

        return response()->json([
            'status'    => true,
            'msg'       => 'Successfully registered Note',
            'type'      => 'success',
            'title'     => 'Perfect!'
        ]);
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
                // 'original_name' => $originalName, // Opcional: guardar nombre original
            ]);

            log_client_activity($clientId, 'File Uploaded', "User {$user->name} uploaded file '{$originalName}' to '{$targetSubdirectory}'.");

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

        log_client_activity($client->id, 'File Downloaded', "User {$user->name} downloaded file: {$originalFileName}");

        return Storage::disk('local')->download($filePathInStorage, $originalFileName);
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
            // Busca archivos cuya URL comience con la ruta del directorio actual + '/'
            // Esto es para eficiencia, el filtro de PHP más abajo es el definitivo para la carpeta exacta.
            ->where('url', 'like', $normalizedCurrentDiskPath . '/%')
            ->with('user:id,name') // Asegúrate que la relación 'user' esté definida en el modelo Files
            ->get();

        foreach ($filesInDb as $fileRecord) {
            $fileStoredDir = dirname($fileRecord->url);
            // Compara el directorio del archivo (normalizado) con el directorio actual (normalizado)
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
                    'size' => $fileSize,
                    'uploaded_at' => $fileRecord->created_at ? $fileRecord->created_at->format('d/m/Y H:i') : 'N/A',
                    'uploaded_by' => $fileRecord->user->name ?? 'N/A',
                    'icon' => $this->getFileIconClass($fileRecord->ext),
                    'download_url' => route('clients.file.download', ['fileId' => $fileRecord->id])
                ];
            }
        }
        return $structure;
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
            log_client_activity($clientId, 'Folder Created', "User created folder: {$newFolderName} in {$currentViewPath}");
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
            log_client_activity($client->id, 'File Deleted', "User deleted file: {$fileName}");
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
            log_client_activity($clientId, 'Folder Deleted', "User deleted folder: {$folderPathRelative}");
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
    public function getClientFilesAjax(Request $request, $clientId) {
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
    public function enviarCorreo($dataClient,$dataActor, $msg)
    {   

        
        if (empty($dataClient->first_name))
        {
            return;
        }

        $name = $dataClient->first_name.' '.$dataClient->last_name;
        // $correo = $dataClient->email;

        $correo = 'wmmartinezc@gmail.com';



        $nameUser = $dataActor->name;

        Mail::to($correo)->send(new NotificacionCliente($name, $nameUser, $msg));

        return 'Correo enviado correctamente';
    }
    public function detail($hash)
    {
     
        if (!Auth::check()) {
            return redirect('/');
        }

        $slug = Crypt::decryptString($hash);
        $user = Auth::user();

        // Check if the user is super admin
        if ($user->type == 1) {
            // Super admin can continue
            $cliente = Client::where('slug', $slug)->firstOrFail();
        } 

        // Check if the user is admin and the client belongs to their company
        elseif ($user->type == 2) {

            
            // 2) busca la compañía por slug
            $cliente = Client::where('slug', $slug)->firstOrFail();

            $clientBelongsToCompany = Client::where('id', $cliente->id)
            ->where('company_id', $user->company_id)
            ->exists();

            if (!$clientBelongsToCompany) {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access to client data.',
                'type'   => 'error'
            ]);
            }
        } 
        // Check if the user is assigned to the client
        elseif ($user->type == 3) {
            $cliente = Client::where('slug', $slug)->firstOrFail();
            $clientAssignedToUser = UserClient::where('client_id', $cliente->id)
            ->where('user_id', $user->id)
            ->exists();

            if (!$clientAssignedToUser) {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access to client data.',
                'type'   => 'error'
            ]);
            }
        } 
        // Other user types are not allowed
        else {
            return response()->json([
            'status' => false,
            'msg'    => 'Unauthorized access.',
            'type'   => 'error'
            ]);
        }



        // Optimización: Usamos Eloquent en lugar de DB::table()
        $client = Client::with([
            // 'userClients.user',
            'avatar',
            'dependents',
            'employment',
            'employment_spouse',
            'business_interests',
            'lawsuits',
            'lawsuit_irs',
            'bankruptcies',
            'beneficiaries_insurance',
            'trustees',
            'trustFunds',
            'safeDepositBoxes',
            'livedAbroads',
            'assetAbroads',
            'bankAccounts',
            'investmentAccounts',
            'digitalAssets',
            'retirementAccounts',
            'creditAccounts',
            'lifeInsurances',
            'assetTransfers',
            'realEstateTransfers',
            'typeResidence',
            'properties',
            'propertySales',
            'vehicles',
            'otherAssets',
            'paymentProcessors',
            'creditCards',
            'businessBankAccounts',
            'companyBankAccounts',
            'companyDigitalAssets',
            'companyAccountReceivables',
            'companyToolEquipments',
            'companyIntangibleAssets',
            'incomeExpensePeriods',
            'ecommerceProcessors',
            'partnersOfficers',
            'businessAffiliations',
            'payrollServiceProviders',
            'relatedPartiesOweBusiness',
            'taxpayerLawsuitsIrs',
            'businessAssetTransfers',
            'incomeChanges',
            'safe',

            'receivables',
            'creditLines',
            'foreignProperties',
            'intangibleAssets',
            'businessLiabilities',
            'monthlyFinancial'
        ])
        ->withCount(['activities', 'files', 'notes']) // Optimiza los conteos con withCount
        ->where('id', $cliente->id);

        $client = $client->first();

        if (!$client) {
            return redirect('clients');
        }
        
        $initialFileStructure = $this->getClientFileStructure($client, '');
        $initialBreadcrumbs = $this->generateBreadcrumbs('');
        $defaultDirectoryStructure = $this->clientDirectoryStructure;

        return view('client.detail', [
            'initialFileStructure' => $initialFileStructure,
            'initialBreadcrumbs' => $initialBreadcrumbs,
            'defaultDirectoryStructure' => $defaultDirectoryStructure,
            'client'                    => $client,
            'payPeriods'                => PayPeriod::all(),
            'bankAccountType'           => BankAccountType::all(),
            'businessTypes'             => BusinessType::all(),
            'states_of_america'         => StateOfAmerica::all(),
            'accountTypes'              => AccountType::all(),
            'id'                        => $client->id,
            'title'                     => 'Module Client | Plataform TaxlabPro'
        ]);
    }
    public function update_info(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
            'status'    => false,
            'msg'       => 'Unauthorized access.',
            'type'      => 'warning'
            ]);
        }

        $user = Auth::user();
        $clientId = $request->input('id'); 

        // Check if the user is super admin
        if ($user->type == 1) {
            // Super admin can continue
        } 
        // Check if the user is admin and the client belongs to their company
        elseif ($user->type == 2) {
            $clientBelongsToCompany = HouseholdMembers::where('client_id', $clientId)
            ->whereHas('client', function ($query) use ($user) {
                $query->where('company_id', $user->company_id);
            })
            ->exists();

            if (!$clientBelongsToCompany) {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access to client data.',
                'type'   => 'error'
            ]);
            }
        } 
        // Check if the user is assigned to the client
        // else {
        //     $clientAssignedToUser = UserClient::where('client_id', $clientId)
        //     ->where('user_id', $user->id)
        //     ->exists();

        //     if (!$clientAssignedToUser) {
        //     return response()->json([
        //         'status' => false,
        //         'msg'    => 'Unauthorized access to client data.',
        //         'type'   => 'error'
        //     ]);
        //     }
        // }

        if (!$request->ajax()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'Invalid request type.',
                'type'      => 'warning'
            ]);
        }

        $name = $request->input('name');
        $value = $request->input('value');

        $householdMembers = HouseholdMembers::where('client_id', 22)->first();
        $householdMembers->$name = $value;
        $householdMembers->save();

        return response()->json([
            'status'    => true,
            'msg'       => 'Information updated correctly',
            'type'      => 'success',
            'title'     => 'Perfect!'
        ]);
    }
    public function update_info_question(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'Unauthorized access.',
                'type'      => 'warning'
            ]);
        }

        $user = Auth::user();

        // Check if the user is super admin
        if ($user->type == 1) {
            // Super admin can continue
        } 
        // Check if the user is admin and the client belongs to their company
        elseif ($user->type == 2) {
            $clientBelongsToCompany = Client::where('id', $id)
                ->where('company_id', $user->company_id)
                ->exists();

            if (!$clientBelongsToCompany) {
                return response()->json([
                    'status' => false,
                    'msg'    => 'Unauthorized access to client data.',
                    'type'   => 'error'
                ]);
            }
        } 
        // Check if the user is assigned to the client
        else {
            $clientAssignedToUser = UserClient::where('client_id', $id)
                ->where('user_id', $user->id)
                ->exists();

            if (!$clientAssignedToUser) {
                return response()->json([
                    'status' => false,
                    'msg'    => 'Unauthorized access to client data.',
                    'type'   => 'error'
                ]);
            }
        }

        if (!$request->ajax()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'Invalid request type.',
                'type'      => 'warning'
            ]);
        }

        $name = $request->input('name');
        $value = $request->input('value');

        $client = Client::find($id);
        $client->$name = $value;
        $client->save();

        log_client_activity($client->id, 'Updated', 'Customer information has been updated');

        return response()->json([
            'status'    => true,
            'msg'       => 'Information updated correctly',
            'type'      => 'success',
            'title'     => 'Perfect!'
        ]);
    }
    function user_by_client(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'Unauthorized access.',
                'type'      => 'warning'
            ]);
        }

        if (!$request->ajax()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'Invalid request type.',
                'type'      => 'warning'
            ]);
        }

        $id = (int) $request->input('id');

        if (empty($id)) {
            return response()->json([
                'status'    => false,
                'msg'       => 'The input id is required.',
                'type'      => 'warning'
            ]);
        }

        $user = Auth::user();

        // Check if the user is super admin
        if ($user->type == 1) {
            // Super admin can access any client
            $client = Client::select('clients.id', 'first_name', 'last_name', 'avatar')
                ->join('user_to_client', 'user_to_client.client_id', 'clients.id')
                ->where('user_to_client.user_id', $id)
                ->get();
        } 
        // Check if the user is admin and the clients belong to their company
        elseif ($user->type == 2) {
            $client = Client::select('clients.id', 'first_name', 'last_name', 'avatar')
                ->join('user_to_client', 'user_to_client.client_id', 'clients.id')
                ->where('user_to_client.user_id', $id)
                ->where('clients.company_id', $user->company_id)
                ->get();
        } 
        // Check if the user is assigned to the client
        else {
            $client = Client::select('clients.id', 'first_name', 'last_name', 'avatar')
                ->join('user_to_client', 'user_to_client.client_id', 'clients.id')
                ->where('user_to_client.user_id', $id)
                ->where('user_to_client.user_id', $user->id)
                ->get();
        }

        if ($client->isEmpty()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'No clients found or unauthorized access.',
                'type'      => 'warning'
            ]);
        }

        return response()->json([
            'status'    => true,
            'msg'       => 'List of clients assigned to the user.',
            'type'      => 'success',
            'data'      => $client
        ]);
    }
    public function clients_search(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access.',
                'type'   => 'error'
            ]);
        }

        $user = Auth::user();
        // Authorization (Only superadmin, admin, and user can search clients)
        if (!in_array($user->type, [1, 2, 3])) {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access.',
                'type'   => 'error'
            ]);
        }

        $term = $request->input('term');

        // Check if the user is super admin
        if ($user->type == 1) {
            $results = Client::select(
                    'id',
                    DB::raw("CONCAT(first_name, ' ', last_name) as full_name")
                )
                ->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$term}%"])
                ->take(10)
                ->get();
        } 
        // Check if the user is admin and the clients belong to their company
        elseif ($user->type == 2) {
            $results = Client::select(
                    'id',
                    DB::raw("CONCAT(first_name, ' ', last_name) as full_name")
                )
                ->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$term}%"])
                ->where('company_id', $user->company_id)
                ->take(10)
                ->get();
        } 
        // Check if the user is assigned to the client
        else {
            $results = Client::select(
                    'id',
                    DB::raw("CONCAT(first_name, ' ', last_name) as full_name")
                )
                ->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$term}%"])
                ->whereHas('userClients', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->take(10)
                ->get();
        }

        // Format the results
        $formattedResults = $results->map(function ($client) {
            return [
                'label' => $client->full_name,
                'value' => $client->id
            ];
        });

        return response()->json($formattedResults);
    }
    public function clients_list()
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access.',
                'type'   => 'error'
            ]);
        }

        $user = Auth::user();

        $query = Client::select(
            'id','slug',
            DB::raw("CONCAT(first_name, ' ', last_name) as full_name")
        );

        // Check if the user is super admin
        if ($user->type == 1) {
            // Super admin can access any client
        } 
        // Check if the user is admin and the clients belong to their company
        elseif ($user->type == 2) {
            $query->where('company_id', $user->company_id);
        } 
        // Check if the user is assigned to the client
        elseif ($user->type == 3) {
            $query->whereHas('userClients', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        } 
        // Other user types are not allowed
        else {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access.',
                'type'   => 'error'
            ]);
        }

        $results = $query->get();

        // Format the response
        $formattedResults = $results->map(function ($client) {
            return [
                'name' => $client->full_name,
                'url'  => route('clients.detail', ['id' => $client->slug]),
                'icon' => ''
            ];
        });

        return response()->json([
            'list' => $formattedResults
        ]);
    }
}
