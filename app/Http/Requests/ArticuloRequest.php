<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloRequest extends FormRequest
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
            'name'=>'required',
            'description'=>'required',
            'stock'=>'required',
            // 'option'=>'required',

        ];
    }
    public function messages()
    {
        return [
            'name.*'=>'El nombre es Obligatorio',
            'description.*'=>'La descripcion es Obligatoria',
            'stock.*'=>'El stock no puede quedas en Blanco ',
            // 'option.*'=>'la option es obligatorioa ',

        ];
    }
}
