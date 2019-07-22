<?php

namespace App\Http\Requests\dashboard\role;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor preencha o campo nome',
            'permissions.required' => 'Por favor selecione alguma permissão',
            'name.unique' => 'Este nome já esta em uso',
        ];
    }
}
