<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MatriculaAndOrdenRequest;
use App\Services\CpsServices;
use App\Traits\CpsUserAndOrden;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use CpsUserAndOrden;

    public function __construct(CpsServices $cpsService)
    {
        $this->setCpsAdapter($cpsService);
    }

    public function validateData(MatriculaAndOrdenRequest $request)
    {
        $matricula = $request->matricula;
        $deviceName = $request->device_name;

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
    }

    public function logout()
    {
        auth('sanctum')->user()->tokens()->delete();
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted',

        ];
    }
}
