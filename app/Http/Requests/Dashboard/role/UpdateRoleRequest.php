<?php

namespace App\Http\Requests\dashboard\role;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class UpdateRoleRequest extends FormRequest
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
        $role = Role::where('name','=',$this->request->get('name'))->first();
        if($role){
            $rules = [
                'name' => 'required|unique:roles,name,'.$role->id,
                'permissions' => 'required',
            ];
        }else{
            $rules = [
                'name' => 'required|unique:roles,name',
                'permissions' => 'required',
            ];
        }


        return $rules;
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
