<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{
    public function createPDFReserva()
    {
        $reserva_id = Session::get('reserva');
        DB::beginTransaction();
        try {
            if ($reserva_id == null) {
                return redirect('paciente/')->with("error", "Usted no tiene Reserva Activa pruebe ingresando otro orden de laboratorio");
            }
            $reserva = Reserva::where('id', $reserva_id)->with('ordenLab:id,codigo')->with('detalleCalendario:id,fecha,grupo_id')->first();
            if ($reserva == null) {
                return redirect('paciente/')->with("error", "El orden ya tiene una reserva.");
            }
            $grupo = $reserva->detalleCalendario->grupo;

            $pdf = DomPDFPDF::loadView('paciente.pdf.pdf-reserva', ["reserva" => $reserva, "grupo" => $grupo])->setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            return $pdf->download($reserva_id . '_' . $grupo->nombre . '.pdf');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            //return redirect()->back();
        }
    }
}
