<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoRequest extends FormRequest
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
            'nombre' => 'required|max:2|alpha',
            'horaInicio' => 'required|max:5|date_format:H:i',
            'horaFin' => 'required|max:5|date_format:H:i'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => "Este campo es requerido",
            'nombre.max' => "Solo se aceptan dos caracteres. Example: SA",
            'nombre.alpha' => "Solo se aceptan letras",
            'horaInicio.required' => "Este campo es requerido.",
            'horaFin.required' => "Este campo es requerido.",
            'horaInicio.date_format' => "La hora de inicio tiene un formato de Hora:min. Ejemplo: 04:30",
            'horaFin.date_format' => "La hora de inicio tiene un formato de Hora:min. Ejemplo: 04:30",
        ];
    }
}
