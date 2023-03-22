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
            'personas_id' =>'required|unique:propuestas,personas_id,' . $this->route('id'),
            'jurados' => 'required',
            'componentes' => 'required',
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
            'personas_id' => 'Emprendedor'
        ];
    }
}
