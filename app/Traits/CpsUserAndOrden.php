<?php

namespace App\Traits;

use App\Models\Ordenlab;
use App\Models\Paciente;
use App\Services\CpsServices;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

trait CpsUserAndOrden
{
    private $restCpsAdapter;

    /*Funciones para verificar usuarios local o online */

    public function setCpsAdapter(CpsServices $service)
    {
        $this->restCpsAdapter = $service;
    }

    private function verificarMatriculaCps($matricula)
    {
        return $this->restCpsAdapter->getUser($matricula);
    }

    private function verificarMatriculaLocal($matricula)
    {
        return Paciente::findMatricula($matricula);
    }

    public function checkMatricula($matricula)
    {
        return $this->restCpsAdapter->checkMatricula($matricula);
    }


    public function verificarMatricula($matricula)
    {
        if (!$this->checkMatricula($matricula)) {
            throw new Exception("¡Matricula inactiva! ", Response::HTTP_FORBIDDEN);
        }
        $paciente = $this->verificarMatriculaLocal($matricula);
        if (!is_null($paciente)) {
            return $paciente;
        }
        $paciente = $this->verificarMatriculaCps($matricula);
        return $paciente;
    }


    /* Funciones para verificar orden de laboratorio local y online */

    private function verificarOrdenLocal($orden)
    {
        return Ordenlab::where("codigo", $orden)
            ->with('paciente:id,matricula,nombre')->first();
    }

    private function verificarOrdenCps($orden)
    {
        $user = Auth::guard('paciente')->user();
        return $this->restCpsAdapter->getOrdenLaboratorio($orden, $user->matricula);
    }

    private function verificarOrdenWithMatriculaCps($orden, $matricula)
    {
        return $this->restCpsAdapter->getOrdenLaboratorio($orden, $matricula);
    }

    private function verificarOrdenWithMatricula($orden, $matricula)
    {
        $ordenLab = $this->verificarOrdenLocal($orden);
        if (!is_null($ordenLab)) {
            return $ordenLab;
        }
        $ordenLab = $this->verificarOrdenWithMatriculaCps($orden, $matricula);
        return $ordenLab;
    }

    private function verificarOrden($orden)
    {
        $ordenLab = $this->verificarOrdenLocal($orden);
        if (!is_null($ordenLab)) {
            return $ordenLab;
        }
        $ordenLab = $this->verificarOrdenCps($orden);
        return $ordenLab;
    }

    /* métodos auxiliares */
    private function matriculaIsValid($paciente)
    {
        if (is_null($paciente)) {
            throw new Exception("matricula incorrecta", Response::HTTP_BAD_REQUEST);
        }
    }
    private function ordenIsValid($orden)
    {
        if (is_null($orden)) {
            throw new Exception("Orden de laboratorio incorrectos", Response::HTTP_BAD_REQUEST);
        }
        if ($this->diffDateOrdenLab($orden->fecha) > $this->days) {
            throw new Exception("Orden de Laboratorio obsoleto '\n' fecha: " . $orden->fecha, Response::HTTP_BAD_REQUEST);
        }
    }

    private function ordenHaveReserva($orden)
    {
        if (!is_null($orden->reserva)) {
            return true;
        }

        return false;
    }
}
