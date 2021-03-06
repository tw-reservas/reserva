<?php

namespace App\Http\Controllers\Paciente;


use App\Http\Controllers\Controller;
use App\Http\Requests\CodigoLabRequest;
use App\Models\DetalleCalendario;
use App\Models\Laboratorio;
use App\Models\Ordenlab;
use App\Models\Reserva;
use App\Services\CpsServices;
use App\Traits\CpsOrden;
use App\Traits\CpsUserAndOrden;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Throwable;

class ReservaController extends Controller
{
    protected $orden;
    //private $cpsAdapter;

    use CpsUserAndOrden;

    public function __construct(CpsServices $cpsService)
    {
        $this->setCpsAdapter($cpsService);
    }

    public function index()
    {
        return view("paciente.index");
    }
    public function verificarCodLab(CodigoLabRequest $request)
    {
        Session::put('reserva', null);
        Session::put('ordenLab', null);
        $orden = $this->verificarOrden($request->orden);
        if ($orden == null) {
            return redirect()->back()->with('error', "Código de laboratorio incorrecto");
        }
        $OrdenLabUser = $orden->paciente;
        if ($OrdenLabUser->matricula != Auth::guard('paciente')->user()->matricula) {
            return redirect()->back()->with('error', "Ingrese el Código de laboratorio del paciente: " . $OrdenLabUser->nombre . " matricula: " . $OrdenLabUser->matricula);
        }
        $reserva = $orden->reserva;
        if ($reserva != null) {
            Session::put('reserva', $reserva->id);
            return redirect('/paciente/reserva/ver');
        }
        Session::put('ordenLab', $request->orden);
        return $this->calendarioView($orden);
    }

    public function calendarioView($orden)
    {
        $now = Carbon::now()->format('Y-m-d');
        $detalle = DetalleCalendario::where("estado", true)
            ->selectRaw("fecha")
            ->selectRaw("(fecha <= '$now') as estado")
            ->selectRaw('(SUM("cupoMaximo") - SUM("cupoOcupado")) as cupoRestante')
            ->groupBy("fecha")->get();
        return view('paciente.content.reserva')->with("detalles", $detalle)->with("orden", $orden);
    }


    public function grupos($orden, $date)
    {
        $detalleCalendario = DetalleCalendario::where("fecha", "=", $date)->with("grupo:id,nombre,horaInicio,horaFin")->orderBy('id', 'asc')->get();
        return response()->json(["detalle" => $detalleCalendario]);
    }

    public function reservar($ordenLab, $detalleId)
    {
        $orden = Ordenlab::where("codigo", $ordenLab)->first();

        if ($orden == null) {
            return redirect('paciente/')->with('error', "Código de laboratorio no existe.");
        }
        if ($orden->reserva != null) {
            return redirect('paciente/reserva/ver')->with("error", "El orden ya tiene una reserva.");
        }
        $fecha = Carbon::now()->format('Y-m-d');
        $user = Auth::guard('paciente')->user();

        DB::beginTransaction();
        try {
            $reserva = new Reserva();
            $reserva->fecha = $fecha;
            $reserva->estado = true; //vigente
            $reserva->ordenlab_id = $orden->id;
            $reserva->detallecalendario_id = $detalleId;
            $reserva->paciente_id = $user->id;
            $reserva->save();
            Session::put('reserva', $reserva->id);
            DB::commit();
            return redirect('paciente/reserva/ver');
        } catch (\Throwable $th) {
            DB::rollBack();
            if ($th->getCode() == "20808") {
                return back()->with("error", "Este grupo no tiene cupo, intente con otro grupo.");
            }
            return redirect()->back()->with("error", "No se pudo programar la orden de laboratorio");
        }
    }




    public function ver()
    {
        $reserva_id = Session::get('reserva');
        if ($reserva_id == null) {
            return redirect('paciente/')->with("error", "Usted no tiene Reserva Activa pruebe ingresando otro orden de laboratorio");
        }
        $re = Reserva::where('id', $reserva_id)->with('ordenLab:id,codigo')->with('detalleCalendario:id,fecha,grupo_id')->first();


        if ($re == null) {
            return redirect('paciente/')->with("error", "El orden ya tiene una reserva.");
        }
        $grupo = $re->detalleCalendario->grupo;
        return view('paciente.content.verReserva')->with("reserva", $re)->with('grupo', $grupo);
        //return view('paciente.pdf.pdf-reserva')->with("reserva", $re)->with('grupo', $grupo);
    }

    public function cancelarReserva()
    {
        $reserva_id = Session::get("reserva");
        $reserva = Reserva::find($reserva_id);
        $reserva->delete();
        Session::put("reserva", null);
        return redirect('paciente/');
    }
}
