<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'usuario' => 'required',
            'contrasena' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'usuario.required' => 'El nombre de usuario es obligatoria',
            'contrasena.required' => 'La contraseña es obligatoria'
        ];
    }
}
