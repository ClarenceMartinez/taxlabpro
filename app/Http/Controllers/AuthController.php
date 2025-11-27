<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de login.
     * El middleware 'guest' se encargará de que solo usuarios no autenticados puedan verla.
     */
    public function showLoginForm()
    {
        return view('login'); // Asumiendo que tu vista se llama login.blade.php
    }

    /**
     * Procesa el intento de inicio de sesión.
     * Diseñado para ser llamado vía AJAX.
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        // 1. Verificar si el usuario existe
        if (!$user) {
            return response()->json([
                'status' => false,
                'msg'    => 'El email ingresado no existe.',
                'title'  => 'Error'
            ], 401); // 401 Unauthorized
        }

        // 2. Verificar si la contraseña es correcta
        if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'status' => false,
                'msg'    => 'La contraseña ingresada no es correcta.',
                'title'  => 'Error'
            ], 401);
        }

        // 3. Verificar si la cuenta está activa
        if ($user->status == 0) {
            return response()->json([
                'status' => false,
                'msg'    => 'Este usuario se encuentra suspendido.',
                'title'  => 'Acceso denegado'
            ], 403); // 403 Forbidden
        }

        // Si todo es correcto, iniciamos sesión
        Auth::login($user);

        // Regeneramos la sesión para seguridad
        $request->session()->regenerate();

        return response()->json([
            'status' => true,
            'msg'    => '¡Bienvenido de nuevo!',
            'title'  => 'Éxito'
        ]);
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigimos a la página raíz, que mostrará el login automáticamente.
        return redirect('/');
    }
}