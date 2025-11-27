<?php

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CustomDatabaseNotification;
use Illuminate\Support\Facades\Gate; // ✅ Correcto


if (!function_exists('send_notification')) {
    /**
     * Enviar una notificación a un usuario.
     *
     * @param int $userId
     * @param string $title
     * @param string $message
     * @param string|null $url
     * @param string|null $icon
     * @param string|null $level
     */
    function send_notification($userId, $title, $message, $url = null, $icon = null, $level = 'info') {
        $user = User::find($userId);

        if ($user) {
            Notification::send($user, new CustomDatabaseNotification([
                'title' => $title,
                'message' => $message,
                'url' => $url,
                'icon' => $icon,
                'level' => $level
            ]));
        }
    }
}
