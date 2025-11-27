<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait ManagesUserPermissions
{
    /**
     * Verifica si el usuario autenticado puede gestionar al usuario objetivo.
     *
     * @param User $targetUser El usuario que se está gestionando.
     * @return bool True si está autorizado, false en caso contrario.
     */
    protected function canManageUser(User $targetUser): bool // Cambiado a protected
    {
        $currentUser = Auth::user();

        if (!$currentUser) {
            return false; // Debería ser capturado por el middleware de autenticación
        }

        // Super Admin puede gestionar a cualquiera
        if ($currentUser->type == 1) {
            return true;
        }

        // Reglas para Admin (Tipo 2)
        if ($currentUser->type == 2) {
            // Admins no pueden gestionar Super Admins
            if ($targetUser->type == 1) {
                return false;
            }
            // Admins solo pueden gestionar usuarios dentro de su propia compañía
            if ($targetUser->company_id == $currentUser->company_id) {
                return true;
            }
        }

        // Otros tipos de usuarios (o Admins gestionando usuarios fuera de su compañía) no pueden gestionar usuarios
        return false;
    }
}