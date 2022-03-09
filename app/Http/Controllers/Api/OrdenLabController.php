<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MatriculaAndOrdenRequest;
use App\Services\CpsServices;
use App\Traits\CpsUserAndOrden;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdenLabController extends Controller
{
    use CpsUserAndOrden;
    protected $days = 30;

    public function __construct(CpsServices $cpsService)
    {
        $this->setCpsAdapter($cpsService);
    }

    private function diffDateOrdenLab($date)
    {
        $dateTime1 = strtotime($date);
        $dateTime2 = strtotime(Carbon::now());
        $days = (int)(($dateTime2 - $dateTime1) / 86400);
        return $days;
    }

    public function validateOrdenLab(MatriculaAndOrdenRequest $request)
    {
        $matricula = $request->matricula;
        $ordenLab = $request->orden_lab;

        $ordenLab = $this->verificarOrdenWithMatricula($ordenLab, $matricula);
        if (is_null($ordenLab)) {
            return response()->json(["message" => "Orden de laboratorio incorrectos", "data" => []], Response::HTTP_BAD_REQUEST);
        }
        if ($this->diffDateOrdenLab($ordenLab->fecha) > $this->days) {
            return response()->json(["message" => "Orden de Laboratorio obsoleto '\n' fecha: " . $ordenLab->fecha], Response::HTTP_BAD_REQUEST);
        }
        $reserva = $ordenLab->reserva;
        if (!is_null($reserva)) {
            return response()->json(["message" => "Orden de laboratorio correcto con reserva ", "data" => [
                "orden" => $ordenLab,
            ]]);
        }
        return response()->json(
            [
                "message" => "Orden correctos",
                "data" => [
                    "orden" => $ordenLab,
                ],
            ],
            Response::HTTP_OK
        );
    }
}
