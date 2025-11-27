<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController; 


Route::middleware('guest')->group(function () {

    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.attempt');

});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/clients/quick-store', [DashboardController::class, 'quickStore'])->name('clients.quick.store');
    Route::get('/clients/list-html', [DashboardController::class, 'getClientListHtml'])->name('clients.list.html');
    Route::post('/clients/details/', [DashboardController::class, 'getClientDetailsAjax'])->name('clients.details.ajax');
    Route::post('/clients/update/{client}', [DashboardController::class, 'updateProfileAjax'])->name('clients.update.ajax');
    Route::post('/clients/header-details', [DashboardController::class, 'getClientHeaderAjax'])->name('clients.header.ajax');
    Route::put('/clients/{clientId}/status', [DashboardController::class, 'updateStatusAjax'])->name('clients.status.update');





    
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
});

Route::controller(DashboardController::class)
    ->prefix('clients')
    ->name('clients.') 
    ->middleware(['auth']) 
    ->group(function() {

        Route::get('/', 'index')->name('index');
        Route::get('/detail/{id}', 'detail')->name('detail'); 
        Route::get('clients/report/pdf/{id}', 'generateClientReportPdf')->name('report.pdf'); 
        Route::post('/save', 'save')->name('save');
        Route::put('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{client}', 'updateProfileAjax')->name('update');
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