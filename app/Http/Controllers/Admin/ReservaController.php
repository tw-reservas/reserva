<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MatriculaAndOrdenRequest;
use App\Services\CpsServices;
use App\Traits\CpsUserAndOrden;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    use CpsUserAndOrden;
    public function __construct(CpsServices $cpsServices)
    {
        $this->setCpsAdapter($cpsServices);
    }

    public function index()
    {
        return view('admin.reserva.index');
    }

    public function verificarUserAndOrden(MatriculaAndOrdenRequest $request)
    {
        $matricula = $request->matricula;
        $paciente = $this->verificarMatricula($matricula);
        $orden_lab = $request->orden_lab;
        $orden = $this->verificarOrdenWithMatricula($orden_lab, $matricula);

        if (is_null($paciente) || is_null($orden)) {
            return back()->with("error", "!!Matricula u orden incorrectos¡¡");
        }
        return back()->with("success", "Datos correctos");
    }
}
