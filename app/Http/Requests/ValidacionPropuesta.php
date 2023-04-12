<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionPropuesta extends FormRequest
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
            'codigo' =>'required|unique:propuestas,codigo,' . $this->route('id')
        ];
    }
    /*public function messages()
{
    return [
        'name.required' => 'El :attribute es obligatorio.',
        'price.required' => 'Añade un :attribute al producto',
        'price.min' => 'El :attribute debe ser mínimo 0'
    ];
}*/
    public function attributes()
    {
        return [
            'codigo' => 'El Codigo'
        ];
    }
}
