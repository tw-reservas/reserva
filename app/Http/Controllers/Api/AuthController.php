<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MatriculaAndOrdenRequest;
use App\Services\CpsServices;
use App\Traits\CpsUserAndOrden;
use App\Traits\RangeDate;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use CpsUserAndOrden;
    use RangeDate;

    public function __construct(CpsServices $cpsService)
    {
        $this->setCpsAdapter($cpsService);
    }

    public function login(MatriculaAndOrdenRequest $request)
    {
        $matricula = $request->matricula;
        $orden = $request->orden_lab;
        $device = $request->device_name;

        try {
            $paciente = $this->verificarMatricula($matricula);

            $orden = $this->verificarOrdenWithMatricula($orden, $matricula);
            /*validando la matricula y el orden de lab */
            $this->matriculaIsValid($paciente);
            $this->ordenIsValid($orden);

            $token = $paciente->createToken($device)->plainTextToken;
            $paciente->token = $device;
            $paciente->update();
            $message = "Datos validos, session iniciada";
            if ($this->ordenHaveReserva($orden)) {
                $message = "Datos validos, session iniciada, orden de lab. con reserva.";
            }
            return response()->json([
                "message" => $message,
                "data" => [
                    "user" => $paciente,
                    "orden" => $orden,
                    "token" => $token,
                ]
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {

            return response()->json(["message" => $th->getMessage(), "matricula" => $matricula], $th->getCode());
        }
    }




    public function validateData(MatriculaAndOrdenRequest $request)
    {
        $matricula = $request->matricula;
        $deviceName = $request->device_name;
        try {
            $paciente = $this->verificarMatricula($matricula);
            if (is_null($paciente)) {
                return response()->json(["message" => "Matricula incorrecto", "data" => []], Response::HTTP_BAD_REQUEST);
            }
            $token = $paciente->createToken($deviceName)->plainTextToken;
            return response()->json(
                [
                    "message" => "Matricula correcta",
                    "data" => [
                        "user" => $paciente,
                        "token" => $token,
                    ],
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage(), "matricula" => $matricula], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout()
    {
        auth('sanctum')->user()->tokens()->delete();
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted',

        ];
    }
}
