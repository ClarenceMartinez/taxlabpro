<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranscriptController;
use App\Http\Controllers\A2AController;
use App\Http\Controllers\ConsoleController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DependentController;
use App\Http\Controllers\EmploymentController;
use App\Http\Controllers\EmploymentSpouseController;
use App\Http\Controllers\BusinessInterestController;
use App\Http\Controllers\LawsuitController;
use App\Http\Controllers\LawsuitIRSController;
use App\Http\Controllers\BankruptcyController;
use App\Http\Controllers\BeneficiaryInsuranceController;
use App\Http\Controllers\TrustFundController;
use App\Http\Controllers\TrusteeController;
use App\Http\Controllers\SafeDepositBoxController;
use App\Http\Controllers\LivedAbroadController;
use App\Http\Controllers\AssetAbroadController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\InvestmentAccountController;
use App\Http\Controllers\DigitalAssetController;
use App\Http\Controllers\RetirementAccountController;
use App\Http\Controllers\CreditAccountController;
use App\Http\Controllers\LifeInsuranceController;
use App\Http\Controllers\AssetTransferController;
use App\Http\Controllers\RealEstateTransferController;
use App\Http\Controllers\TypeResidenceController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertySaleController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\OtherAssetController;
use App\Http\Controllers\UtilsController;

use App\Http\Controllers\PaymentProcessorController;
use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\BusinessBankAccountController;
use App\Http\Controllers\CompanyBankAccountController;
use App\Http\Controllers\CompanyDigitalAssetController;
use App\Http\Controllers\CompanyAccountReceivableController;
use App\Http\Controllers\CompanyToolEquipmentController;
use App\Http\Controllers\CompanyIntangibleAssetController;
use App\Http\Controllers\IncomeExpensePeriodController;

use App\Http\Controllers\EcommerceProcessorController;
use App\Http\Controllers\PartnerOfficerController;
use App\Http\Controllers\BusinessAffiliationController;
use App\Http\Controllers\PayrollServiceProviderController;
use App\Http\Controllers\RelatedPartyOweBusinessController;
use App\Http\Controllers\TaxpayerLawsuitIrsController;
use App\Http\Controllers\BusinessAssetTransferController;
use App\Http\Controllers\IncomeChangeController;
use App\Http\Controllers\SafeController;

use App\Http\Controllers\ReceivableController;
use App\Http\Controllers\CreditLineController;
use App\Http\Controllers\ForeignPropertyController;
use App\Http\Controllers\IntangibleAssetController;
use App\Http\Controllers\BusinessLiabilityController;
use App\Http\Controllers\ClientServiceController;

use App\Http\Controllers\MonthlyFinancialController;
use App\Http\Controllers\TaskController;



// Middleware 'guest' redirige a los usuarios ya logueados si intentan visitar estas rutas.
Route::middleware('guest')->group(function () {
    // La raíz para invitados ahora redirige directamente a la vista de login.
    Route::get('/', function () {
        // En lugar de llamar al controlador, es más limpio y directo retornar la vista o una redirección.
        return view('auth.login'); // O como se llame tu vista de login
    })->name('index'); // Le damos un nombre por si acaso, aunque 'login' es más útil.

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login'); // Asumiendo que tienes un método para mostrar el form
    Route::post('login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
});

// Ruta de Logout (puede estar fuera del grupo 'auth' ya que necesitas estar logueado para usarla)
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Requieren Autenticación)
|--------------------------------------------------------------------------
|
| Todas las rutas dentro de este grupo requieren que el usuario esté logueado.
|
*/
Route::middleware('auth')->group(function () {

    // --- DASHBOARD ---
    // Esta ruta centraliza la lógica de redirección post-login.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // --- ADMINISTRACIÓN: USUARIOS Y COMPAÑÍAS ---
    Route::prefix('users')->name('users.')->controller(UserController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'save')->name('save'); // Debería ser 'store' por convención
        Route::get('/profile/{id?}', 'profile')->name('profile'); // {id?} es opcional
        Route::put('/{user}', 'update')->name('update'); // Usando Route Model Binding y PUT
        Route::delete('/{user}', 'destroy')->name('destroy'); // Usando DELETE
        // Rutas para JSON/Ajax
        Route::get('/json', 'users_json')->name('users_json');
        Route::get('/json-by-company', 'users_json_by_company')->name('users_json_by_company');
        Route::get('/mentions', 'mentions')->name('mentions');
    });

    Route::prefix('company')->name('company.')->controller(CompanyController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('save');
        Route::get('/json', 'company_json')->name('company_json');
        Route::put('/{company}', 'update')->name('update');
        Route::delete('/{company}', 'destroy')->name('destroy');
        // Rutas específicas
        Route::get('/{company:slug}','show')->name('show');
        Route::get('/{hash}/account', 'account')->name('account')->where('hash', '.*');
        Route::get('/{hash}/teams', 'teams')->name('teams')->where('hash', '.*');
        // ... otras rutas con hash ...
    });


    // --- CORE: GESTIÓN DE CLIENTES ---
    // Este grupo ya estaba bien organizado. Se han hecho pequeños ajustes de consistencia.
    Route::prefix('clients')->name('clients.')->controller(ClientController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'save')->name('save'); // Para crear un nuevo cliente
        Route::get('/list', 'clients_list')->name('list');
        Route::get('/search', 'clients_search')->name('search');
        Route::get('/{client}/detail', 'detail')->name('detail'); // Usando Route Model Binding
        
        // Operaciones sobre un cliente existente
        Route::put('/{client}', 'update')->name('update');
        Route::post('/info', 'info')->name('info');
        Route::post('/asigment_to_user', 'asigment_to_user')->name('asigment_to_user');
        
        // Pestañas de Actividad, Notas, Archivos
        Route::post('/activities', 'activities_post')->name('activities_post');
        Route::post('/notes', 'notes_post')->name('notes_post');
        Route::delete('/notes/{note}', 'delete_notes')->name('delete_notes');
        
        // File Manager
        Route::prefix('/{client}/files')->name('files.')->group(function() {
            Route::get('/', 'getClientFilesAjax')->name('ajax');
            Route::post('/upload', 'files_post')->name('post'); // Antes estaba fuera
            Route::post('/create-folder', 'createClientFolderAjax')->name('folder.create');
            Route::delete('/delete-folder', 'deleteClientFolderAjax')->name('folder.delete');
        });
        
        // Operaciones sobre archivos específicos
        Route::prefix('file')->name('file.')->group(function() {
             Route::get('/{file}/download', 'downloadClientFile')->name('download');
             Route::get('/{file}/view', 'viewClientFile')->name('view');
             Route::post('/{file}/rename', 'renameClientFileAjax')->name('rename');
             Route::delete('/{file}/delete', 'deleteClientFileAjax')->name('delete');
        });

        // Portal de Cliente
        Route::prefix('portal')->name('portal.')->group(function () {
            Route::post('/check-status', 'checkClientPortalUserStatus')->name('check_status');
            Route::post('/create-user', 'createClientPortalUser')->name('create_user');
            Route::post('/change-password', 'changeClientPortalPassword')->name('change_password');
        });

        // Generación de PDFs
        Route::prefix('/{client}/pdf')->name('pdf.')->group(function() {
            Route::get('/report', 'generateClientReportPdf')->name('report');
            Route::get('/f433d', 'pdf_f433d')->name('f433d');
            Route::get('/f433a', 'pdf_f433a')->name('f433a');
            // ... otros pdfs ...
        });
    });


    // --- RECURSOS RELACIONADOS AL CLIENTE (API-Style) ---
    // Aquí está la mayor mejora. Agrupamos todos los controladores que siguen el mismo patrón.
    // Usamos Route::apiResource para simplificar, o lo definimos manualmente si apiResource no encaja perfectamente.
    // El patrón es: index by client, store, update, destroy.
    
    function addClientApiRoutes(string $prefix, string $controller, string $paramName) {
        Route::prefix($prefix)->name("{$prefix}.")->controller($controller)->group(function() use ($paramName) {
            Route::get('/client/{client}', 'index')->name('index'); // Ruta para obtener listado por cliente
            Route::post('/', 'store')->name('store');
            Route::put("/{{$paramName}}", 'update')->name('update'); // Usando Route Model Binding
            Route::delete("/{{$paramName}}", 'destroy')->name('destroy');
        });
    }

    // Personales
    addClientApiRoutes('dependents', \App\Http\Controllers\DependentController::class, 'dependent');
    addClientApiRoutes('employments', \App\Http\Controllers\EmploymentController::class, 'employment');
    addClientApiRoutes('employments-spouse', \App\Http\Controllers\EmploymentSpouseController::class, 'employmentSpouse');
    // ... agrega todos los demás que siguen este patrón ...
    addClientApiRoutes('bank-accounts', \App\Http\Controllers\BankAccountController::class, 'bankAccount');
    addClientApiRoutes('vehicles', \App\Http\Controllers\VehicleController::class, 'vehicle');
    addClientApiRoutes('other-assets', \App\Http\Controllers\OtherAssetController::class, 'otherAsset');
    // De Negocios
    addClientApiRoutes('business-interests', \App\Http\Controllers\BusinessInterestController::class, 'businessInterest');
    addClientApiRoutes('business-liability', \App\Http\Controllers\BusinessLiabilityController::class, 'businessLiability');
    // etc. ¡Esto reduce más de 100 líneas de código a unas pocas llamadas de función!


    // --- FUNCIONALIDADES GENERALES DE LA APP ---
    Route::prefix('calendar')->name('calendar.')->controller(CalendarController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/events', 'list_event')->name('list_event');
        Route::post('/events', 'add_event')->name('add_event');
        Route::put('/events', 'update_event')->name('update_event');
    });

    Route::prefix('notify')->name('notify.')->controller(NotificationController::class)->group(function() {
        Route::post('/', 'index')->name('index');
        Route::post('/my-notifications', 'my_notify')->name('my_notify');
        Route::post('/{id}/read', 'markAsRead')->name('markAsRead');
    });

    Route::prefix('task')->name('task.')->controller(TaskController::class)->group(function() {
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'edit')->name('edit'); // Debería ser 'update' y el método PUT
        Route::post('/update', 'update')->name('update'); // Esta ruta parece redundante con la de arriba
    });


    // --- UTILIDADES Y DESARROLLO ---
    Route::prefix('utils')->name('utils.')->controller(UtilsController::class)->group(function () {
        Route::get('/pay-periods', 'getPeriods')->name('payperiods');
        Route::get('/bank-account-types', 'bankAccountType')->name('bankAccountType');
        Route::get('/business-types', 'businessType')->name('businessType');
    });

    // Mantener separadas las rutas de desarrollo
    Route::prefix('dev')->name('dev.')->controller(\App\Http\Controllers\A2AController::class)->group(function() {
        Route::get('/', 'dev')->name('dash');
        Route::post('/call', 'call')->name('call');
    });

});