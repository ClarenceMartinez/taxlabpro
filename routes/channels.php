<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// [NUEVO] Canal para las actualizaciones de la lista de clientes
Broadcast::channel('company.{companyId}.clients', function ($user, $companyId) {
    // Solo permite el acceso si el usuario es de tipo 1 (superadmin)
    // o si el company_id del usuario coincide con el del canal.
    return $user->type == 1 || (int) $user->company_id === (int) $companyId;
});