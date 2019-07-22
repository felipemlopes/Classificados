<?php

namespace App\Http\Requests\dashboard\category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Permission;

class UpdateCategoryRequest extends FormRequest
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
        $category = Category::where('name','=',$this->request->get('name'))->first();
        if($category){
            $rules = [
                'name' => 'required|unique:categories,name,'.$category->id,
                'parent_id' => ''
            ];
        }else{
            $rules = [
                'name' => 'required|unique:categories,name',
                'parent_id' => ''
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
