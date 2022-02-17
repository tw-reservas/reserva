<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MatriculaAndOrdenRequest;
use App\Services\CpsServices;
use App\Traits\CpsUserAndOrden;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdenLabController extends Controller
{
    use CpsUserAndOrden;

    public function __construct(CpsServices $cpsService)
    {
        $this->setCpsAdapter($cpsService);
    }

    public function validateOrdenLab(MatriculaAndOrdenRequest $request)
    {
        $matricula = $request->matricula;
        $ordenLab = $request->orden_lab;

        $ordenLab = $this->verificarOrdenWithMatricula($ordenLab, $matricula);
        if (is_null($ordenLab)) {
            return response()->json(["message" => "Orden de laboratorio incorrectos", "data" => []], Response::HTTP_BAD_REQUEST);
        }
        $reserva = $ordenLab->reserva;
        if (!is_null($reserva)) {
            return response()->json(["message" => "Orden de laboratorio incorrectos", "data" => [
                "reserva" => $reserva,
                "orden" => $ordenLab,
            ]], Response::HTTP_BAD_REQUEST);
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
