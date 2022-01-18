<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CupoRequest extends FormRequest
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
            'cupo' => 'required|digits_between:1,3|numeric'
        ];
    }

    public function messages()
    {
        return [
            'cupo|required' => "El campo es requerido",
            'cupo.numeric' => "Solo se aceptan digitos",
            'cupo.digits_between' => 'Digitos del 1 al 999',
        ];
    }
}
