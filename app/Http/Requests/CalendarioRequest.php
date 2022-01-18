<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarioRequest extends FormRequest
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
            'cantidad' => 'required|numeric|between:10,60',
            'fechaInicio' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'cantidad.required' => "Este campo es requerido",
            'cantidad.numeric' => "Solo se aceptan números entre 1 a 60",
            'fechaInicio.required' => "La fecha de inicio es requerida",
            'fechaInicio.date' => "Error de parámetro, Solo se admiten fechas",
        ];
    }
}
