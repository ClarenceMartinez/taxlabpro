<?php
use Illuminate\Support\Facades\Auth;
// app/Helpers/ActivityHelper.php

use App\Models\ClientActivityLog;

if (!function_exists('log_client_activity')) {
    function log_client_activity($clientId, $action, $description = null)
    {
        ClientActivityLog::create([
            'client_id'   => $clientId,
            'user_id'     => Auth::check() ? Auth::id() : null,
            'action'      => $action,
            'description' => $description,
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
        ]);
    }
}