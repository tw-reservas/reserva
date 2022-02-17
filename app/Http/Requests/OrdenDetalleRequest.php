<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdenDetalleRequest extends FormRequest
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
            'orden_lab' => 'required|numeric|digits_between:6,12|exists:ordenlabs,codigo',
            'detalle_id' => 'required|numeric|digits_between:6,12|exists:detalles_calendarios,id'
        ];
    }
}
