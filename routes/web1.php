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


Route::get('/', function () {
  if (auth()->check()) {
    return redirect()->route('clients.index');
  }
  return app()->make('App\Http\Controllers\ConsoleController')->index();
})->name('index');

Route::get('login', [ConsoleController::class, 'login'])->name('login');
Route::resource('welcome','App\Http\Controllers\PanelController')->names('welcome');

Route::controller(AuthController::class)->prefix('auth')->group(function() {
    Route::post('/authenticate', 'authenticate')->name('auth.authenticate'); 
    Route::get('/logout', 'logout')->name('auth.logoutt'); 
    Route::get('/auth/logout', 'logout')->name('auth.logout'); 
});
Route::middleware(['auth'])->group(function () {
    Route::controller(App\Http\Controllers\DashboardController::class)->prefix('dashboard')->group(function() {
      Route::get('/', 'index')->name('dashboard.index');
    });
    Route::controller(UserController::class)->prefix('users')->group(function() {
        Route::get('/', 'index')->name('users.index');
        Route::get('/users_json', 'users_json')->name('users.users_json'); 
        // Route::get('/users_json_by_company', 'users_json_by_company')->name('users.users_json_by_company'); 
        Route::get('/users-json-by-company', 'users_json_by_company')->name('users.users_json_by_company');

        Route::post('/save', 'save')->name('users.save'); 
        Route::post('/edit', 'edit')->name('users.edit'); 
        Route::post('/update', 'update')->name('users.update'); 
        Route::post('/delete', 'destroy')->name('users.destroy'); 
        Route::get('/profile/{id}', 'profile')->name('users.profile'); 
        Route::get('/profile', 'profile')->name('users.profilee'); 
        Route::post('/list', 'list')->name('users.list'); 
        Route::get('/user_mentions', 'mentions')->name('users.mentions'); 
    });

    Route::controller(CompanyController::class)->prefix('company')->group(function() {
        Route::get('/', 'index')->name('company.index');
        Route::get('/company_json', 'company_json')->name('company.company_json'); 
        Route::post('/save', 'store')->name('company.save'); 
        Route::post('/edit', 'edit')->name('company.edit'); 
        Route::post('/update', 'update')->name('company.update'); 
        Route::post('/delete', 'destroy')->name('company.destroy'); 
        Route::get('/account/{hash}', 'account')->name('company.account')->where('hash', '.*');
        Route::get('/teams/{hash}', 'teams')->name('company.teams')->where('hash', '.*');
        Route::get('/bills/{hash}', 'bills')->name('company.bills')->where('hash', '.*');
        Route::get('/notifications/{hash}', 'notifications')->name('company.notifications')->where('hash', '.*');
        Route::get('/connections/{hash}', 'connections')->name('company.connections')->where('hash', '.*');
        Route::get('/{company:slug}','show')->name('show');
    });

  Route::controller(ClientController::class)
      ->prefix('clients')
      ->name('clients.') 
      ->middleware(['auth']) 
      ->group(function() {

          Route::get('/', 'index')->name('index');
          Route::get('/detail/{id}', 'detail')->name('detail'); 
          Route::get('clients/report/pdf/{id}', 'generateClientReportPdf')->name('report.pdf'); 
          Route::post('/save', 'save')->name('save');

          Route::put('/edit/{id}', 'edit')->name('edit');
          Route::put('/update/{id}', 'update')->name('update');
          Route::post('/asigment_to_user', 'asigment_to_user')->name('asigment_to_user');
          Route::get('/clients_json', 'clients_json')->name('clients_json');
          Route::post('/info', 'info')->name('info'); // {id} del cliente se pasa en el cuerpo del request
          Route::post('/activities_post', 'activities_post')->name('activities_post'); // client_id en el cuerpo
          Route::post('/notes_post', 'notes_post')->name('notes_post'); // client_id en el cuerpo
          Route::delete('/delete_notes/{id}', 'delete_notes')->name('delete_notes');
          Route::post('/files_post', 'files_post')->name('files_post'); // client_id y file en el cuerpo

          // PDFs (el {id} aquí es el ID numérico del cliente)
          Route::get('/pdf_f433d/{id}', 'pdf_f433d')->name('pdf_f433d'); // Nota: tu controlador pdf_f433d no usa {id}
          Route::get('/pdf_f433a/{id}', 'pdf_f433a')->name('pdf_f433a');
          Route::get('/pdf_f433b/{id}', 'pdf_f433b')->name('pdf_f433b');
          Route::get('/pdf_f2848/{id}', 'pdf_f2848')->name('pdf_f2848');
          Route::get('/pdf_f8821/{id}', 'pdf_f8821')->name('pdf_f8821');

          Route::get('/info_asign/{id}', 'info_asign')->name('info_asign'); // {id} es client_id
          Route::post('/update_info', 'update_info')->name('update_info'); // client_id_target_update en el cuerpo
          Route::put('/update_info_question/{id}', 'update_info_question')->name('update_info_question'); // {id} es client_id
          Route::post('/user_by_client', 'user_by_client')->name('user_by_client'); // {id} del usuario en el cuerpo
          Route::get('/search', 'clients_search')->name('search'); // 'term' como query param
          Route::get('/list', 'clients_list')->name('list');

          // --- Rutas para el File Manager (Operaciones a nivel de Cliente/Carpeta) ---
          Route::get('/{clientId}/files-ajax', 'getClientFilesAjax')->name('files.ajax');
          Route::post('/{clientId}/create-folder', 'createClientFolderAjax')->name('folder.create');
          Route::delete('/{clientId}/delete-folder', 'deleteClientFolderAjax')->name('folder.delete');

          // --- Rutas para el File Manager (Operaciones a nivel de Archivo Específico) ---
          Route::get('/files/{fileId}/download', 'downloadClientFile')->name('file.download');
          Route::get('/files/{fileId}/view', 'viewClientFile')->name('file.view'); 
          Route::post('/files/{fileId}/rename', 'renameClientFileAjax')->name('file.rename'); 
          Route::delete('/files/{fileId}/delete', 'deleteClientFileAjax')->name('file.delete');
          Route::post('/portal/check-user-status', 'checkClientPortalUserStatus')->name('portal.check_status');
          Route::post('/portal/create-user', 'createClientPortalUser')->name('portal.create_user');
          Route::post('/portal/change-password', 'changeClientPortalPassword')->name('portal.change_password');
  });
	Route::controller(A2AController::class)->prefix('dev')->group(function() {
		Route::get('/', 'dev')->name('dev.dash'); 
		Route::post('/call', 'call')->name('dev.call'); 
	  });


    Route::controller(CalendarController::class)->prefix('calendar')->group(function() {
        Route::get('/', 'index')->name('calendar.index'); 
        Route::get('/list_event', 'list_event')->name('calendar.list_event'); 
        Route::post('/add_event', 'add_event')->name('calendar.add_event'); 
        Route::put('/update_event', 'update_event')->name('calendar.update_event'); 
    });

    Route::controller(NotificationController::class)->prefix('notify')->group(function() {
        Route::post('/', 'index')->name('notify.index');
        Route::post('/my_notify', 'my_notify')->name('notify.my_notify');
        Route::post('/{id}/read', 'markAsRead')->name('markAsRead');

    });

    Route::prefix('dependents')->group(function () {
        Route::post('/store', [DependentController::class, 'store'])->name('dependents.store');
        Route::put('/update/{id}', [DependentController::class, 'update'])->name('dependents.update');
        Route::delete('/delete/{id}', [DependentController::class, 'destroy'])->name('dependents.destroy');
    });

    Route::prefix('employments')->group(function () {
        Route::post('/store', [EmploymentController::class, 'store'])->name('employments.store');
        Route::put('/update/{id}', [EmploymentController::class, 'update'])->name('employments.update');
        Route::delete('/delete/{id}', [EmploymentController::class, 'destroy'])->name('employments.destroy');
    });

    Route::prefix('employments_spouse')->group(function () {
        Route::post('/store', [EmploymentSpouseController::class, 'store'])->name('employments_spouse.store');
        Route::put('/update/{id}', [EmploymentSpouseController::class, 'update'])->name('employments_spouse.update');
        Route::delete('/delete/{id}', [EmploymentSpouseController::class, 'destroy'])->name('employments_spouse.destroy');
    });

    Route::prefix('business_interests')->group(function () {
		Route::get('/{client_id}', [BusinessInterestController::class, 'index'])->name('business_interests.client');
		Route::post('/', [BusinessInterestController::class, 'store'])->name('business_interests.store');
		Route::put('/{id}', [BusinessInterestController::class, 'update'])->name('business_interests.update');
		Route::delete('/{id}', [BusinessInterestController::class, 'destroy'])->name('business_interests.destroy');
    });

    Route::prefix('lawsuit')->group(function () {
		Route::get('/{client_id}', [LawsuitController::class, 'index'])->name('lawsuit.client');
		Route::post('/', [LawsuitController::class, 'store'])->name('lawsuit.store');
		Route::put('/{id}', [LawsuitController::class, 'update'])->name('lawsuit.update');
		Route::delete('/{id}', [LawsuitController::class, 'destroy'])->name('lawsuit.destroy');
    });
    
    Route::prefix('lawsuit_irs')->group(function () {
		Route::get('/{client_id}', [LawsuitIRSController::class, 'index'])->name('lawsuit_irs.client');
		Route::post('/', [LawsuitIRSController::class, 'store'])->name('lawsuit_irs.store');
		Route::put('/{id}', [LawsuitIRSController::class, 'update'])->name('lawsuit_irs.update');
		Route::delete('/{id}', [LawsuitIRSController::class, 'destroy'])->name('lawsuit_irs.destroy');
    });

    Route::prefix('bankruptcies')->group(function () {
		Route::get('/{client_id}', [BankruptcyController::class, 'index'])->name('bankruptcies.client');
		Route::post('/', [BankruptcyController::class, 'store'])->name('bankruptcies.store');
		Route::put('/{id}', [BankruptcyController::class, 'update'])->name('bankruptcies.update');
		Route::delete('/{id}', [BankruptcyController::class, 'destroy'])->name('bankruptcies.destroy');
    });

    Route::prefix('beneficiaryinsurance')->group(function () {
		Route::get('/{client_id}', [BeneficiaryInsuranceController::class, 'index'])->name('beneficiaryinsurance.client');
		Route::post('/', [BeneficiaryInsuranceController::class, 'store'])->name('beneficiaryinsurance.store');
		Route::put('/{id}', [BeneficiaryInsuranceController::class, 'update'])->name('beneficiaryinsurance.update');
		Route::delete('/{id}', [BeneficiaryInsuranceController::class, 'destroy'])->name('beneficiaryinsurance.destroy');
    });

    Route::prefix('trustFund')->group(function () {
		Route::get('/{client_id}', [TrustFundController::class, 'index'])->name('trustFund.client');
		Route::post('/', [TrustFundController::class, 'store'])->name('trustFund.store');
		Route::put('/{id}', [TrustFundController::class, 'update'])->name('trustFund.update');
		Route::delete('/{id}', [TrustFundController::class, 'destroy'])->name('trustFund.destroy');
    });

    Route::prefix('trusteer')->group(function () {
		Route::get('/{client_id}', [TrusteeController::class, 'index'])->name('trusteer.client');
		Route::post('/', [TrusteeController::class, 'store'])->name('trusteer.store');
		Route::put('/{id}', [TrusteeController::class, 'update'])->name('trusteer.update');
		Route::delete('/{id}', [TrusteeController::class, 'destroy'])->name('trusteer.destroy');
    });

    Route::prefix('SafeDepositBox')->group(function () {
		Route::get('/{client_id}', [SafeDepositBoxController::class, 'index'])->name('SafeDepositBox.client');
		Route::post('/', [SafeDepositBoxController::class, 'store'])->name('SafeDepositBox.store');
		Route::put('/{id}', [SafeDepositBoxController::class, 'update'])->name('SafeDepositBox.update');
		Route::delete('/{id}', [SafeDepositBoxController::class, 'destroy'])->name('SafeDepositBox.destroy');
    });

    Route::prefix('livedAbroad')->group(function () {
		Route::get('/{client_id}', [LivedAbroadController::class, 'index'])->name('livedAbroad.client');
		Route::post('/', [LivedAbroadController::class, 'store'])->name('livedAbroad.store');
		Route::put('/{id}', [LivedAbroadController::class, 'update'])->name('livedAbroad.update');
		Route::delete('/{id}', [LivedAbroadController::class, 'destroy'])->name('livedAbroad.destroy');
    });

    Route::prefix('assetAbroad')->group(function () {
		Route::get('/{client_id}', [AssetAbroadController::class, 'index'])->name('assetAbroad.client');
		Route::post('/', [AssetAbroadController::class, 'store'])->name('assetAbroad.store');
		Route::put('/{id}', [AssetAbroadController::class, 'update'])->name('assetAbroad.update');
		Route::delete('/{id}', [AssetAbroadController::class, 'destroy'])->name('assetAbroad.destroy');
    });

    Route::prefix('bankAccounts')->group(function () {
    	Route::get('/{client_id}', [BankAccountController::class, 'index'])->name('bankAccounts.client');
		Route::post('/', [BankAccountController::class, 'store'])->name('bankAccounts.store');
		Route::put('/{id}', [BankAccountController::class, 'update'])->name('bankAccounts.update');
		Route::delete('/{id}', [BankAccountController::class, 'destroy'])->name('bankAccounts.destroy');
    });
  
    Route::prefix('investmentAccounts')->group(function () {
    	Route::get('/{client_id}', [InvestmentAccountController::class, 'index'])->name('investmentAccounts.client');
		Route::post('/', [InvestmentAccountController::class, 'store'])->name('investmentAccounts.store');
		Route::put('/{id}', [InvestmentAccountController::class, 'update'])->name('investmentAccounts.update');
		Route::delete('/{id}', [InvestmentAccountController::class, 'destroy'])->name('investmentAccounts.destroy');
    });
  
    Route::prefix('digitalAssets')->group(function () {
    	Route::get('/{client_id}', [DigitalAssetController::class, 'index'])->name('digitalAssets.client');
		Route::post('/', [DigitalAssetController::class, 'store'])->name('digitalAssets.store');
		Route::put('/{id}', [DigitalAssetController::class, 'update'])->name('digitalAssets.update');
		Route::delete('/{id}', [DigitalAssetController::class, 'destroy'])->name('digitalAssets.destroy');
    });

    Route::prefix('retirementAccounts')->group(function () {
    	Route::get('/{client_id}', [RetirementAccountController::class, 'index'])->name('retirementAccounts.client');
		Route::post('/', [RetirementAccountController::class, 'store'])->name('retirementAccounts.store');
		Route::put('/{id}', [RetirementAccountController::class, 'update'])->name('retirementAccounts.update');
		Route::delete('/{id}', [RetirementAccountController::class, 'destroy'])->name('retirementAccounts.destroy');
    });

    Route::prefix('creditAccounts')->group(function () {
    	Route::get('/{client_id}', [CreditAccountController::class, 'index'])->name('creditAccounts.client');
		Route::post('/', [CreditAccountController::class, 'store'])->name('creditAccounts.store');
		Route::put('/{id}', [CreditAccountController::class, 'update'])->name('creditAccounts.update');
		Route::delete('/{id}', [CreditAccountController::class, 'destroy'])->name('creditAccounts.destroy');
    });

    Route::prefix('lifeInsurances')->group(function () {
    	Route::get('/{client_id}', [LifeInsuranceController::class, 'index'])->name('lifeInsurances.client');
		Route::post('/', [LifeInsuranceController::class, 'store'])->name('lifeInsurances.store');
		Route::put('/{id}', [LifeInsuranceController::class, 'update'])->name('lifeInsurances.update');
		Route::delete('/{id}', [LifeInsuranceController::class, 'destroy'])->name('lifeInsurances.destroy');
    });
    
    Route::prefix('assetTransfers')->group(function () {
    	Route::get('/{client_id}', [AssetTransferController::class, 'index'])->name('assetTransfers.client');
		Route::post('/', [AssetTransferController::class, 'store'])->name('assetTransfers.store');
		Route::put('/{id}', [AssetTransferController::class, 'update'])->name('assetTransfers.update');
		Route::delete('/{id}', [AssetTransferController::class, 'destroy'])->name('assetTransfers.destroy');
    });
   
    Route::prefix('realStateTransfers')->group(function () {
    	Route::get('/{client_id}', [RealEstateTransferController::class, 'index'])->name('realStateTransfers.client');
		Route::post('/', [RealEstateTransferController::class, 'store'])->name('realStateTransfers.store');
		Route::put('/{id}', [RealEstateTransferController::class, 'update'])->name('realStateTransfers.update');
		Route::delete('/{id}', [RealEstateTransferController::class, 'destroy'])->name('realStateTransfers.destroy');
    });

   
    Route::prefix('typeResidence')->group(function () {
    	Route::get('/{client_id}', [TypeResidenceController::class, 'index'])->name('typeResidence.client');
		Route::post('/', [TypeResidenceController::class, 'store'])->name('typeResidence.store');
		Route::put('/{id}', [TypeResidenceController::class, 'update'])->name('typeResidence.update');
		Route::delete('/{id}', [TypeResidenceController::class, 'destroy'])->name('typeResidence.destroy');
    });
   
    Route::prefix('property')->group(function () {
    	Route::get('/{client_id}', [PropertyController::class, 'index'])->name('property.client');
		Route::post('/', [PropertyController::class, 'store'])->name('property.store');
		Route::put('/{id}', [PropertyController::class, 'update'])->name('property.update');
		Route::delete('/{id}', [PropertyController::class, 'destroy'])->name('property.destroy');
    });

    Route::prefix('propertySale')->group(function () {
    	Route::get('/{client_id}', [PropertySaleController::class, 'index'])->name('propertySale.client');
		Route::post('/', [PropertySaleController::class, 'store'])->name('propertySale.store');
		Route::put('/{id}', [PropertySaleController::class, 'update'])->name('propertySale.update');
		Route::delete('/{id}', [PropertySaleController::class, 'destroy'])->name('propertySale.destroy');
    });

    Route::prefix('vehicles')->group(function () {
    	Route::get('/{client_id}', [VehicleController::class, 'index'])->name('vehicles.client');
		Route::post('/', [VehicleController::class, 'store'])->name('vehicles.store');
		Route::put('/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
		Route::delete('/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
    });

    Route::prefix('otherAssets')->group(function () {
    	Route::get('/{client_id}', [OtherAssetController::class, 'index'])->name('otherAssets.client');
		Route::post('/', [OtherAssetController::class, 'store'])->name('otherAssets.store');
		Route::put('/{id}', [OtherAssetController::class, 'update'])->name('otherAssets.update');
		Route::delete('/{id}', [OtherAssetController::class, 'destroy'])->name('otherAssets.destroy');
    });

    Route::prefix('utils')->group(function () {
    	Route::get('/payperiods', [UtilsController::class, 'getPeriods'])->name('utils.payperiods');
    	Route::get('/bankAccountType', [UtilsController::class, 'bankAccountType'])->name('utils.bankAccountType');
    	Route::get('/businessType', [UtilsController::class, 'businessType'])->name('utils.businessType');
    });

    Route::prefix('paymentProcessor')->group(function () {
    	Route::get('/{client_id}', [PaymentProcessorController::class, 'index'])->name('paymentProcessor.client');
		Route::post('/', [PaymentProcessorController::class, 'store'])->name('paymentProcessor.store');
		Route::put('/{id}', [PaymentProcessorController::class, 'update'])->name('paymentProcessor.update');
		Route::delete('/{id}', [PaymentProcessorController::class, 'destroy'])->name('paymentProcessor.destroy');
    });

    Route::prefix('creditCards')->group(function () {
    	Route::get('/{client_id}', [CreditCardController::class, 'index'])->name('creditCards.client');
		Route::post('/', [CreditCardController::class, 'store'])->name('creditCards.store');
		Route::put('/{id}', [CreditCardController::class, 'update'])->name('creditCards.update');
		Route::delete('/{id}', [CreditCardController::class, 'destroy'])->name('creditCards.destroy');
    });

    Route::prefix('businessBanksAccount')->group(function () {
    	Route::get('/{client_id}', [BusinessBankAccountController::class, 'index'])->name('businessBanksAccount.client');
		Route::post('/', [BusinessBankAccountController::class, 'store'])->name('businessBanksAccount.store');
		Route::put('/{id}', [BusinessBankAccountController::class, 'update'])->name('businessBanksAccount.update');
		Route::delete('/{id}', [BusinessBankAccountController::class, 'destroy'])->name('businessBanksAccount.destroy');
    });

    Route::prefix('companyBanksAccount')->group(function () {
    	Route::get('/{client_id}', [CompanyBankAccountController::class, 'index'])->name('companyBanksAccount.client');
		Route::post('/', [CompanyBankAccountController::class, 'store'])->name('companyBanksAccount.store');
		Route::put('/{id}', [CompanyBankAccountController::class, 'update'])->name('companyBanksAccount.update');
		Route::delete('/{id}', [CompanyBankAccountController::class, 'destroy'])->name('companyBanksAccount.destroy');
    });

    Route::prefix('companyDigitalAssets')->group(function () {
    	Route::get('/{client_id}', [CompanyDigitalAssetController::class, 'index'])->name('companyDigitalAssets.client');
		Route::post('/', [CompanyDigitalAssetController::class, 'store'])->name('companyDigitalAssets.store');
		Route::put('/{id}', [CompanyDigitalAssetController::class, 'update'])->name('companyDigitalAssets.update');
		Route::delete('/{id}', [CompanyDigitalAssetController::class, 'destroy'])->name('companyDigitalAssets.destroy');
    });

    Route::prefix('companyAccountReceivable')->group(function () {
    	Route::get('/{client_id}', [CompanyAccountReceivableController::class, 'index'])->name('companyAccountReceivable.client');
		Route::post('/', [CompanyAccountReceivableController::class, 'store'])->name('companyAccountReceivable.store');
		Route::put('/{id}', [CompanyAccountReceivableController::class, 'update'])->name('companyAccountReceivable.update');
		Route::delete('/{id}', [CompanyAccountReceivableController::class, 'destroy'])->name('companyAccountReceivable.destroy');
    });

    Route::prefix('companyToolEquipment')->group(function () {
    	Route::get('/{client_id}', [CompanyToolEquipmentController::class, 'index'])->name('companyToolEquipment.client');
		Route::post('/', [CompanyToolEquipmentController::class, 'store'])->name('companyToolEquipment.store');
		Route::put('/{id}', [CompanyToolEquipmentController::class, 'update'])->name('companyToolEquipment.update');
		Route::delete('/{id}', [CompanyToolEquipmentController::class, 'destroy'])->name('companyToolEquipment.destroy');
    });

    Route::prefix('companyIntangibleAssets')->group(function () {
    	Route::get('/{client_id}', [CompanyIntangibleAssetController::class, 'index'])->name('companyIntangibleAssets.client');
		Route::post('/', [CompanyIntangibleAssetController::class, 'store'])->name('companyIntangibleAssets.store');
		Route::put('/{id}', [CompanyIntangibleAssetController::class, 'update'])->name('companyIntangibleAssets.update');
		Route::delete('/{id}', [CompanyIntangibleAssetController::class, 'destroy'])->name('companyIntangibleAssets.destroy');
    });

    Route::prefix('incomeExpensePeriod')->group(function () {
    	Route::get('/{client_id}', [IncomeExpensePeriodController::class, 'index'])->name('incomeExpensePeriod.client');
		Route::post('/', [IncomeExpensePeriodController::class, 'store'])->name('incomeExpensePeriod.store');
		Route::put('/{id}', [IncomeExpensePeriodController::class, 'update'])->name('incomeExpensePeriod.update');
		Route::delete('/{id}', [IncomeExpensePeriodController::class, 'destroy'])->name('incomeExpensePeriod.destroy');
    });


    Route::prefix('ecommerceprocessor')->group(function () {
    	Route::get('/{client_id}', [EcommerceProcessorController::class, 'index'])->name('ecommerceprocessor.client');
		Route::post('/', [EcommerceProcessorController::class, 'store'])->name('ecommerceprocessor.store');
		Route::put('/{id}', [EcommerceProcessorController::class, 'update'])->name('ecommerceprocessor.update');
		Route::delete('/{id}', [EcommerceProcessorController::class, 'destroy'])->name('ecommerceprocessor.destroy');
    });

    Route::prefix('partnerOffice')->group(function () {
    	Route::get('/{client_id}', [PartnerOfficerController::class, 'index'])->name('partnerOffice.client');
		Route::post('/', [PartnerOfficerController::class, 'store'])->name('partnerOffice.store');
		Route::put('/{id}', [PartnerOfficerController::class, 'update'])->name('partnerOffice.update');
		Route::delete('/{id}', [PartnerOfficerController::class, 'destroy'])->name('partnerOffice.destroy');
    });

    Route::prefix('businessAffiliation')->group(function () {
    	Route::get('/{client_id}', [BusinessAffiliationController::class, 'index'])->name('businessAffiliation.client');
		Route::post('/', [BusinessAffiliationController::class, 'store'])->name('businessAffiliation.store');
		Route::put('/{id}', [BusinessAffiliationController::class, 'update'])->name('businessAffiliation.update');
		Route::delete('/{id}', [BusinessAffiliationController::class, 'destroy'])->name('businessAffiliation.destroy');
    });

    Route::prefix('payrollService')->group(function () {
    	Route::get('/{client_id}', [PayrollServiceProviderController::class, 'index'])->name('payrollService.client');
		Route::post('/', [PayrollServiceProviderController::class, 'store'])->name('payrollService.store');
		Route::put('/{id}', [PayrollServiceProviderController::class, 'update'])->name('payrollService.update');
		Route::delete('/{id}', [PayrollServiceProviderController::class, 'destroy'])->name('payrollService.destroy');
    });

    Route::prefix('relatedPartyOwe')->group(function () {
    	Route::get('/{client_id}', [RelatedPartyOweBusinessController::class, 'index'])->name('relatedPartyOwe.client');
		Route::post('/', [RelatedPartyOweBusinessController::class, 'store'])->name('relatedPartyOwe.store');
		Route::put('/{id}', [RelatedPartyOweBusinessController::class, 'update'])->name('relatedPartyOwe.update');
		Route::delete('/{id}', [RelatedPartyOweBusinessController::class, 'destroy'])->name('relatedPartyOwe.destroy');
    });

    Route::prefix('taxpayerLawsuit')->group(function () {
    	Route::get('/{client_id}', [TaxpayerLawsuitIrsController::class, 'index'])->name('taxpayerLawsuit.client');
		Route::post('/', [TaxpayerLawsuitIrsController::class, 'store'])->name('taxpayerLawsuit.store');
		Route::put('/{id}', [TaxpayerLawsuitIrsController::class, 'update'])->name('taxpayerLawsuit.update');
		Route::delete('/{id}', [TaxpayerLawsuitIrsController::class, 'destroy'])->name('taxpayerLawsuit.destroy');
    });

    Route::prefix('businessAssetTransfer')->group(function () {
    	Route::get('/{client_id}', [BusinessAssetTransferController::class, 'index'])->name('businessAssetTransfer.client');
		Route::post('/', [BusinessAssetTransferController::class, 'store'])->name('businessAssetTransfer.store');
		Route::put('/{id}', [BusinessAssetTransferController::class, 'update'])->name('businessAssetTransfer.update');
		Route::delete('/{id}', [BusinessAssetTransferController::class, 'destroy'])->name('businessAssetTransfer.destroy');
    });

    Route::prefix('incomeChange')->group(function () {
    	Route::get('/{client_id}', [IncomeChangeController::class, 'index'])->name('incomeChange.client');
		Route::post('/', [IncomeChangeController::class, 'store'])->name('incomeChange.store');
		Route::put('/{id}', [IncomeChangeController::class, 'update'])->name('incomeChange.update');
		Route::delete('/{id}', [IncomeChangeController::class, 'destroy'])->name('incomeChange.destroy');
    });

    Route::prefix('safe')->group(function () {
    	Route::get('/{client_id}', [SafeController::class, 'index'])->name('safe.client');
		Route::post('/', [SafeController::class, 'store'])->name('safe.store');
		Route::put('/{id}', [SafeController::class, 'update'])->name('safe.update');
		Route::delete('/{id}', [SafeController::class, 'destroy'])->name('safe.destroy');
    });

    Route::prefix('receivable')->group(function () {
    	Route::get('/{client_id}', [ReceivableController::class, 'index'])->name('receivable.client');
		Route::post('/', [ReceivableController::class, 'store'])->name('receivable.store');
		Route::put('/{id}', [ReceivableController::class, 'update'])->name('receivable.update');
		Route::delete('/{id}', [ReceivableController::class, 'destroy'])->name('receivable.destroy');
    });

    Route::prefix('creditLine')->group(function () {
    	Route::get('/{client_id}', [CreditLineController::class, 'index'])->name('creditLine.client');
		Route::post('/', [CreditLineController::class, 'store'])->name('creditLine.store');
		Route::put('/{id}', [CreditLineController::class, 'update'])->name('creditLine.update');
		Route::delete('/{id}', [CreditLineController::class, 'destroy'])->name('creditLine.destroy');
    });


    Route::prefix('foreignProperty')->group(function () {
    	Route::get('/{client_id}', [ForeignPropertyController::class, 'index'])->name('foreignProperty.client');
		Route::post('/', [ForeignPropertyController::class, 'store'])->name('foreignProperty.store');
		Route::put('/{id}', [ForeignPropertyController::class, 'update'])->name('foreignProperty.update');
		Route::delete('/{id}', [ForeignPropertyController::class, 'destroy'])->name('foreignProperty.destroy');
    });

    Route::prefix('intangibleAsset')->group(function () {
    	Route::get('/{client_id}', [IntangibleAssetController::class, 'index'])->name('intangibleAsset.client');
		Route::post('/', [IntangibleAssetController::class, 'store'])->name('intangibleAsset.store');
		Route::put('/{id}', [IntangibleAssetController::class, 'update'])->name('intangibleAsset.update');
		Route::delete('/{id}', [IntangibleAssetController::class, 'destroy'])->name('intangibleAsset.destroy');
    });

    Route::prefix('businessLiability')->group(function () {
    	Route::get('/{client_id}', [BusinessLiabilityController::class, 'index'])->name('businessLiability.client');
		Route::post('/', [BusinessLiabilityController::class, 'store'])->name('businessLiability.store');
		Route::put('/{id}', [BusinessLiabilityController::class, 'update'])->name('businessLiability.update');
		Route::delete('/{id}', [BusinessLiabilityController::class, 'destroy'])->name('businessLiability.destroy');
    });


    Route::prefix('clientService')->group(function () {
    	Route::get('/{client_id}', [ClientServiceController::class, 'index'])->name('clientService.client');
		Route::post('/', [ClientServiceController::class, 'store'])->name('clientService.store');
		Route::put('/{id}', [ClientServiceController::class, 'update'])->name('clientService.update');
		Route::delete('/{id}', [ClientServiceController::class, 'destroy'])->name('clientService.destroy');
    });

    Route::prefix('monthlyFinancial')->group(function () {
    	Route::get('/{client_id}', [MonthlyFinancialController::class, 'index'])->name('monthlyFinancial.client');
		Route::post('/', [MonthlyFinancialController::class, 'store'])->name('monthlyFinancial.store');
		Route::put('/{id}', [MonthlyFinancialController::class, 'update'])->name('monthlyFinancial.update');
		Route::delete('/{id}', [MonthlyFinancialController::class, 'destroy'])->name('monthlyFinancial.destroy');
    });


    Route::controller(TaskController::class)->prefix('task')->group(function() {
        Route::post('/store', 'store')->name('task.store'); 
        Route::put('/{id}', 'edit')->name('task.edit'); 
        Route::post('/update', 'update')->name('task.update'); 
    });

});