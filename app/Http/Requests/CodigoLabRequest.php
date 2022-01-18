<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodigoLabRequest extends FormRequest
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
            'orden' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'orden.required' => "Este campo es requerido",
            'orden.numeric' => "Solo se aceptan números entre 1 a 60",
        ];
    }
}
