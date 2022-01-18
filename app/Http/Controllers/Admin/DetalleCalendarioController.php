<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendario;
use App\Models\Cupo;
use App\Models\DetalleCalendario;
use App\Models\Grupo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DetalleCalendarioController extends Controller
{
    public function index()
    {
        $calendarios = Calendario::all()->sortBy('estado');
        $grupos = Grupo::where("estado", true)->get();
        $cupo = Cupo::where("estado", true)->first();
        return view('admin.detalle-calendario.index')
            ->with('calendarios', $calendarios)
            ->with('grupos', $grupos)
            ->with('cupo', $cupo);
    }

    public function repartir(Calendario $calendario, Cupo $cupo)
    {
        if ($calendario->detalleCalendario()->first() != null || $calendario->estado) {
            return redirect()->back()->with('error', "Calendario activado");
        }

        $grupos = Grupo::select(['id', 'porcentaje'])->where("estado", true)->orderBy('id')->get();
        $start = Carbon::createFromFormat('Y-m-d', $calendario->fechaInicio);
        $end = Carbon::createFromFormat('Y-m-d', $calendario->fechaFin);

        for ($i = $start; $i <= $end; $i->addDay()) {
            if ($i->dayOfWeek == Carbon::SUNDAY || $i->dayOfWeek == Carbon::SATURDAY) {
            } else {
                foreach ($grupos as $grupo => $value) {
                    $detalle = new DetalleCalendario();
                    $detalle->cupoMaximo = $value->porcentaje;
                    $detalle->cupoOcupado = 0;
                    $detalle->fecha = $i->format('Y-m-d');
                    $detalle->estado = true;
                    $detalle->cupo_id = $cupo->id;
                    $detalle->grupo_id = $value->id;
                    $detalle->calendario_id = $calendario->id;
                    $detalle->save();
                }
            }

            $calendario->estado =   !$calendario->estado;
            $calendario->update();
            return redirect()->back()->with('success', "Cupos Repartidos con éxitos");
        }
    }

    public function verDetalles(Calendario $calendario)
    {
        $detalle = $calendario->detalleCalendario()->with('grupo:id,nombre')->get();
        //dd($detalle);
        return view('admin.detalle-calendario.ver-detalle')->with('detalles', $detalle)->with('calendario', $calendario);
    }
}
