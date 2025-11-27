<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Cambia a `false` si quieres restringirlo
    }

    /**
     * Define las reglas de validación.
     */
    public function rules(): array
    {
        return [
            'first_name'        => 'required|string|max:255',
            'mi'                => 'nullable|string|max:10',
            'last_name'         => 'required|string|max:255',
            'ssn'               => 'nullable|string|max:20',
            'date_birth'        => 'nullable|date',
            'dl'                => 'nullable|string|max:50',
            'dl_state'          => 'nullable|string|max:50',
            'has_passport'      => 'nullable|boolean',
            'client_reference'  => 'nullable|string|max:255',
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'El nombre es obligatorio.',
            'last_name.required'  => 'El apellido es obligatorio.',
            // 'ssn.required'        => 'El SSN es obligatorio.',
            // 'date_birth.required' => 'La fecha de nacimiento es obligatoria.',
            // 'date_birth.date'     => 'La fecha de nacimiento debe ser válida.',
        ];
    }
}
