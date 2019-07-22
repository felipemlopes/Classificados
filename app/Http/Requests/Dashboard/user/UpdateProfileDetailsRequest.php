<?php

namespace App\Http\Requests\dashboard\user;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileDetailsRequest extends FormRequest
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

        $user = User::where('email','=',$this->request->get('email'))->first();
        $rule = '';
        if($user == null){
            $rule = 'required|email|'.Rule::unique('users', 'email');
        }elseif($user != null and $user->name != $this->request->get('name')){
            $rule = 'required|email|'.Rule::unique('users', 'email');
        }else{
            $rule = 'required|email|'.Rule::unique('users', 'email')->ignore($user->id);
        }

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => $rule,
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Por favor preencha o campo nome',
            'last_name.required' => 'Por favor preencha o campo nome',
            'email.required' => 'Por favor preencha o campo e-mail',
            'email.email' => 'Informe um endereço de email válido',
            'email.unique' => 'Este e-mail já esta em uso por outro usuário',
        ];
    }
}
