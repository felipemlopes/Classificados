<?php

namespace App\Http\Requests\dashboard\user;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|confirmed|min:6',
        ];
    }


    public function messages()
    {
        return [
            'first_name.required' => 'Por favor preencha o campo nome',
            'last_name.required' => 'Por favor preencha o campo nome',
            'email.required' => 'Por favor preencha o campo e-mail',
            'password.required' => 'Por favor preencha o campo status',
            'password.confirmed' => 'A confirmação da senha não corresponde',
            'password.min' => 'A senha deve ter pelo menos :min caracteres',
            'email.email' => 'Informe um endereço de email válido',
            'email.unique' => 'Este e-mail já esta em uso por outro usuário',
        ];
    }
}
