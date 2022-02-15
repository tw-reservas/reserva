<?php

namespace App\Traits;

use App\Models\Ordenlab;
use App\Models\Paciente;
use App\Services\CpsServices;
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


    public function verificarMatricula($matricula)
    {
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
}
