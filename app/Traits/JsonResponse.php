<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait JsonResponse
{


    private function response($data = [], $message = "La operación se ejecuto correctamente", $code = Response::HTTP_OK)
    {
        return response()->json(["data" => $data, "message" => $message], $code);
    }

    protected function errorResponse($message, $code)
    {
        return $this->response([], $message, $code);
    }

    protected function successResponse($data, $message)
    {
        return $this->response($data, $message);
    }
}
