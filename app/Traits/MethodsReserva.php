<?php

namespace App\Traits;

use App\Models\DetalleCalendario;
use App\Models\Ordenlab;
use App\Models\Paciente;
use App\Models\Reserva;
use App\Services\CpsServices;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait MethodsReserva
{
    public function programReservar($ordenLab, $detalleId)
    {
        $orden = Ordenlab::where("codigo", $ordenLab)->first();

        if ($orden == null) {
            return redirect('paciente/')->with('error', "Código de laboratorio no existe.");
        }
        if ($orden->reserva != null) {
            return redirect('paciente/reserva/ver')->with("error", "El orden ya tiene una reserva.");
        }
        $fecha = Carbon::now()->format('Y-m-d');
        DB::beginTransaction();
        try {
            $reserva = new Reserva();
            $reserva->fecha = $fecha;
            $reserva->estado = true; //vigente
            $reserva->ordenlab_id = $orden->id;
            $reserva->detallecalendario_id = $detalleId;
            $reserva->paciente_id = $orden->paciente->id;
            $reserva->save();
            //Session::put('reserva', $reserva->id);
            DB::commit();
            //return redirect('paciente/reserva/ver');
            return $reserva;
        } catch (\Throwable $th) {
            DB::rollBack();
            if ($th->getCode() == "20808") {
                //generar una exception
                throw new Exception("Este grupo no tiene cupo, intente con otro grupo.", 1);
            }
            throw new Exception("No se pudo programar la orden de laboratorio", 1);
        }
    }

    public function ver($reserva)
    {
        if ($reserva == null) {
            return redirect()->back()->with("error", "Usted no tiene Reserva Activa pruebe ingresando otro orden de laboratorio");
        }
        $re = Reserva::where('id', $reserva->id)->with('ordenLab:id,codigo')->with('detalleCalendario:id,fecha,grupo_id')->first();
        if ($re == null) {
            return redirect()->back()->with("error", "El orden ya tiene una reserva.");
        }

        $reservaNew = Reserva::where("id", $reserva->id)->with(['ordenLab:id,codigo', 'detalleCalendario:id,fecha,grupo_id', 'detalleCalendario.grupo', 'ordenLab.laboratorios.requisitos'])->first();
        return $reservaNew;
        //return view('paciente.content.verReserva')->with("reserva", $re)->with('grupo', $grupo);
        //return view('paciente.pdf.pdf-reserva')->with("reserva", $re)->with('grupo', $grupo);
    }

    public function getGruposMethod($fecha)
    {
        $grupos = DetalleCalendario::where("fecha", $fecha)
            ->select('detalles_calendarios.*', 'grupos.nombre', 'grupos.horaInicio', 'grupos.horaFin')
            ->join('grupos', "detalles_calendarios.grupo_id", 'grupos.id')
            ->orderBy("id")->get();
        return $grupos;
    }
}
