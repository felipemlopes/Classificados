<?php

namespace App\Http\Requests\dashboard\permission;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Permission;

class UpdatePermissionRequest extends FormRequest
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
        $permission = Permission::where('name','=',$this->request->get('name'))->first();
        if($permission){
            $rules = [
                'name' => 'required|unique:permissions,name,'.$permission->id,
            ];
        }else{
            $rules = [
                'name' => 'required|unique:permissions,name'
            ];
        }


        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor preencha o campo nome',
            'name.unique' => 'Este nome já esta em uso',
        ];
    }
}
