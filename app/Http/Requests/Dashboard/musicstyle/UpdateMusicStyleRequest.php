<?php

namespace App\Http\Requests\dashboard\musicstyle;

use App\Models\MusicStyle;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Permission;

class UpdateMusicStyleRequest extends FormRequest
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
        $style = MusicStyle::where('name','=',$this->request->get('name'))->first();
        if($style){
            $rules = [
                'name' => 'required|unique:music_styles,name,'.$style->id,
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
