<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'        => 'required|string|max:255',
            'mi'                => 'nullable|string|max:10',
            'last_name'         => 'required|string|max:255',
            'ssn'               => 'required|string|max:20',
            'date_birth'        => 'required|date',
            'dl'                => 'nullable|string|max:50',
            'dl_state'          => 'nullable|string|max:50',
            'has_passport'      => 'nullable|boolean',
            'client_reference'  => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'El nombre es obligatorio.',
            'last_name.required'  => 'El apellido es obligatorio.',
            'ssn.required'        => 'El SSN es obligatorio.',
            'date_birth.required' => 'La fecha de nacimiento es obligatoria.',
            'date_birth.date'     => 'La fecha de nacimiento debe ser válida.',
        ];
    }
}
