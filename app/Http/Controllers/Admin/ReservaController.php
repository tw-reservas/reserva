<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MatriculaAndOrdenRequest;
use App\Models\DetalleCalendario;
use App\Models\Reserva;
use App\Services\CpsServices;
use App\Traits\CpsUserAndOrden;
use App\Traits\MethodsReserva;
use App\Traits\RangeDate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    use CpsUserAndOrden;
    use RangeDate;
    use MethodsReserva;
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
        try {
            $matricula = $request->matricula;
            $paciente = $this->verificarMatricula($matricula);
            $orden_lab = $request->orden_lab;
            $orden = $this->verificarOrdenWithMatricula($orden_lab, $matricula);
            $messageError = $this->verifyError($paciente, $orden);
            $haveReserva = $this->verifyReserva($orden);

            if ($messageError != "" || $haveReserva != "") {
                //dd($messageError);
                return back()->with("error", $messageError);
            }
            return $this->reservaCalendario($paciente, $orden);
        } catch (\Throwable $th) {
            return back()->with("error", "!!Matricula inactiva !!");
        }
    }

    private function verifyReserva($orden)
    {
        if (!is_null($orden->reserva)) {
            return 'El orden de laboratorio tiene una reserva!. <a href="" > ver reserva </a>';
        }
        return "";
    }

    private function verifyError($paciente, $orden)
    {
        if (is_null($paciente) || is_null($orden)) {
            return "!! Matricula u orden incorrectos ¡¡";
        }
        if ($this->diffDateOrdenLab($orden->fecha) > $this->days) {
            return "Orden de laboratorio caducado Fecha: " . $orden->fecha;
        }

        return "";
    }

    private function reservaCalendario($paciente, $orden)
    {
        $detalles = $this->getDateOfDetalleCalendario();
        return view("admin.reserva.calendario.calendario", compact("detalles", "orden", "paciente"));
    }

    public function getGrupos($orden, $date)
    {
        $detalleCalendario = DetalleCalendario::where("fecha", "=", $date)->where("estado", true)->with("grupo:id,nombre,horaInicio,horaFin")->orderBy('id', 'asc')->get();
        return response()->json(["detalle" => $detalleCalendario]);
    }

    public function reservar($ordenLab, $detalleId)
    {
        try {
            $reserva = $this->programReservar($ordenLab, $detalleId);
            return redirect("admin/reserva/" . $reserva->id . "/ver");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", $th->getMessage());
        }
    }

    public function showPageVerReserva()
    {
        return view('admin.reserva.index', ["ver" => "ver-reserva"]);
    }

    public function showReserva(Reserva $reserva)
    {
        $detalleReserva = $this->ver($reserva);
        return view("admin.reserva.show-reserva", compact("detalleReserva"));
    }

    public function verifyUserAndOrdenVer(MatriculaAndOrdenRequest $request)
    {
        try {
            $matricula = $request->matricula;
            $paciente = $this->verificarMatricula($matricula);
            $orden_lab = $request->orden_lab;
            $orden = $this->verificarOrdenWithMatricula($orden_lab, $matricula);
            $messageError = $this->verifyError($paciente, $orden);
            if ($messageError != "") {
                return redirect()->back()->with('error', nl2br($messageError));
            }
            if (is_null($orden->reserva)) {
                return redirect()->back()->with('error', "El orden de laboratorio no tiene una reserva");
            }
            return redirect("admin/reserva/" . $orden->reserva->id . "/ver");
        } catch (\Throwable $th) {
            return back()->with("error", "!!Matricula inactiva !!");
        }
    }

    public function cancelarReserva(Reserva $reserva)
    {
        $reserva->delete();
        return redirect('admin/ver')->with("success", "La reserva ha sido cancelado con éxito");
    }
}
