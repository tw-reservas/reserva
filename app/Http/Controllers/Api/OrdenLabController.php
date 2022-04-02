<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MatriculaAndOrdenRequest;
use App\Services\CpsServices;
use App\Traits\CpsUserAndOrden;
use App\Traits\RangeDate;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdenLabController extends Controller
{
    use CpsUserAndOrden;
    use RangeDate;

    public function __construct(CpsServices $cpsService)
    {
        $this->setCpsAdapter($cpsService);
    }



    public function validateOrdenLab(MatriculaAndOrdenRequest $request)
    {
        $matricula = $request->matricula;
        $ordenLab = $request->orden_lab;

        try {
            $ordenLab = $this->verificarOrdenWithMatricula($ordenLab, $matricula);
            $this->ordenIsValid($ordenLab);
            if ($this->ordenHaveReserva($ordenLab)) {
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
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], $th->getCode());
        }
    }
}
