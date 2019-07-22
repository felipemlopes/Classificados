<?php

namespace App\Http\Requests\dashboard\user;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoginDetailsRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => 'A confirmação da senha não corresponde',
            'password.min' => 'A senha deve ter pelo menos :min caracteres',
            'password.required' => 'Por favor preencha o campo nova senha',
            'password_confirmation.required'  => 'Por favor preencha o campo confirmar nova senha',
        ];
    }
}
