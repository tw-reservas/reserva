<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrdenDetalleRequest;
use App\Models\Ordenlab;
use App\Models\Reserva;
use App\Traits\MethodsReserva;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class ReservaController extends Controller
{
    use MethodsReserva;
    public function reservar(OrdenDetalleRequest $request)
    {
        $orden = $request->orden_lab;
        $detalleId = $request->detalle_id;
        $orden = Ordenlab::where("codigo", $orden)->with('reserva')->first();
        $user = auth('sanctum')->user();
        $fecha = Carbon::now()->format('Y-m-d');
        if (!is_null($orden->reserva)) {
            return response()->json([
                "mensaje" => "Este orden ya tiene una reserva",
                "data" => [],

            ], Response::HTTP_BAD_REQUEST);
        }
        DB::beginTransaction();
        try {
            $reserva = new Reserva();
            $reserva->fecha = $fecha;
            $reserva->estado = true; //vigente
            $reserva->ordenlab_id = $orden->id;
            $reserva->detallecalendario_id = $detalleId;
            $reserva->paciente_id = $user->id;
            $reserva->save();
            DB::commit();
            return response()->json(["data" => [
                "reserva" => $reserva,
            ]], Response::HTTP_OK);
        } catch (\Throwable $th) {
            DB::rollBack();
            if ($th->getCode() == "20808") {
                return response()->json([
                    "mensaje" => "Cupo lleno",
                    "data" => [],

                ], Response::HTTP_CONFLICT);
            }
            return response()->json([
                "mensaje" => "No se pudo programar la orden de laboratorio",
                "data" => [],

            ], Response::HTTP_CONFLICT);
        }
    }

    public function verReserva(Reserva $reserva, Request $request)
    {
        $user = auth('sanctum')->user();
        $reserva = $this->ver($reserva);
        return response()->json([
            "data" => [
                "reserva" => $reserva,
                "user" => $user,
            ]
        ]);
    }
}
