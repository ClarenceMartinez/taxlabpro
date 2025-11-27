<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        
    }
    
    public function my_notify() {
        if (empty(auth()->id()))
        {
            return redirect('/');
        }


        $user = User::find(auth()->id()); 
        $notifications = $user->unreadNotifications; 

        return response()->json($notifications);
    }

    public function markAsRead($id)
    {
        // Buscar la notificación por ID para el usuario autenticado
        $notification = Auth::user()->notifications()->where('id', $id)->first();

        if (!$notification) {
            return response()->json(['message' => 'Notificación no encontrada'], 404);
        }

        // Marcar la notificación como leída
        $notification->markAsRead();

        return response()->json(['message' => 'Notificación marcada como leída'], 200);
    }
}
