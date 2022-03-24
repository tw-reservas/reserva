<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetalleCalendario;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class GrupoController extends Controller
{
    private $predefinedTime = "09:45";
    public function getGrupos($fecha)
    {
        //$detalle = DetalleCalendario::where("fecha", $fecha)->with("grupo:id,nombre,horaInicio,horaFin")->orderBy('id', 'asc')->get();
        $now = Carbon::now();
        $dateSelected = Carbon::parse($fecha);
        $timeNow = strtotime($now->format("H:m"));
        if ($dateSelected->diff($now)->days <= 0 && $timeNow > strtotime($this->predefinedTime)) {
            return response()->json(["message" => "No se puede reservar en este dia", "data" => []], Response::HTTP_BAD_REQUEST);
        }
        $cupos = DetalleCalendario::where("fecha", $fecha)->select('detalles_calendarios.*', 'grupos.nombre', 'grupos.horaInicio', 'grupos.horaFin')->join('grupos', "detalles_calendarios.grupo_id", 'grupos.id')->orderBy("id")->get();
        return response()->json(["data" => $cupos, "fecha" => $fecha]);
    }
}
