<?php

namespace App\Http\Requests\frontend\user;

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
        if (setting('tos')){
            return [
                'email' => 'required|email|unique:users,email',
                'first_name' => 'required',
                'last_name' => 'required',
                'password' => 'required|confirmed|min:6',
                'tos' => 'required',
            ];
        }else{
            return [
                'email' => 'required|email|unique:users,email',
                'first_name' => 'required',
                'last_name' => 'required',
                'password' => 'required|confirmed|min:6',
            ];
        }

    }


    public function messages()
    {
        if (setting('tos')){
            return [
                'first_name.required' => 'Por favor preencha o campo nome',
                'last_name.required' => 'Por favor preencha o campo nome',
                'email.required' => 'Por favor preencha o campo e-mail',
                'password.required' => 'Por favor preencha o campo status',
                'password.confirmed' => 'A confirmação da senha não corresponde',
                'password.min' => 'A senha deve ter pelo menos :min caracteres',
                'email.email' => 'Informe um endereço de email válido',
                'email.unique' => 'Este e-mail já esta em uso por outro usuário',
                'tos.required' => 'Por favor aceite os termos de uso',
            ];
        }else{
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
}
