<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetalleCalendario;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function getGrupos($fecha)
    {
        //$detalle = DetalleCalendario::where("fecha", $fecha)->with("grupo:id,nombre,horaInicio,horaFin")->orderBy('id', 'asc')->get();
        $cupos = DetalleCalendario::where("fecha", $fecha)->select('detalles_calendarios.*', 'grupos.nombre', 'grupos.horaInicio', 'grupos.horaFin')->join('grupos', "detalles_calendarios.grupo_id", 'grupos.id')->orderBy("id")->get();
        return response()->json(["data" => $cupos, "fecha" => $fecha]);
    }
}
