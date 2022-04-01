<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetalleCalendario;
use App\Traits\MethodsReserva;
use App\Traits\RangeDate;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class GrupoController extends Controller
{
    use MethodsReserva;
    use RangeDate;

    public function getGrupos($fecha)
    {
        //$detalle = DetalleCalendario::where("fecha", $fecha)->with("grupo:id,nombre,horaInicio,horaFin")->orderBy('id', 'asc')->get();
        if (!$this->hourAndDateValidate($fecha)) {
            return response()->json(["message" => "No se puede reservar en este dia", "data" => []], Response::HTTP_BAD_REQUEST);
        }
        //$cupos = DetalleCalendario::where("fecha", $fecha)->select('detalles_calendarios.*', 'grupos.nombre', 'grupos.horaInicio', 'grupos.horaFin')->join('grupos', "detalles_calendarios.grupo_id", 'grupos.id')->orderBy("id")->get();
        $cupos = $this->getGruposMethod($fecha);
        return response()->json(["data" => $cupos, "fecha" => $fecha]);
    }
}
