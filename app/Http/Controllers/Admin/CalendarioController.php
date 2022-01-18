<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarioRequest;
use App\Models\Calendario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendario = Calendario::all();
        return view('admin.calendario.index')->with('calendarios', $calendario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fecha = Calendario::all('fechaFin')->max('fechaFin');
        $fecha = Carbon::parse($fecha)->addDay()->format('Y-m-d');
        return view('admin.calendario.create')->with('fecha', $fecha);
    }


    public function store(CalendarioRequest $request)
    {
        $cantidad = $request->cantidad;
        $now = Carbon::now()->format("Y-m-d");
        $fechaForm = Carbon::parse($request->fechaInicio)->format("Y-m-d");
        if ($fechaForm == $now) {
            return back()->with("error", "La fecha debe ser mayor a " . $now);
        }
        $fecha = Calendario::all('fechaFin')->max('fechaFin');


        if ($fecha != null) {
            if ($fechaForm <= $fecha) {
                return back()->with("error", "Fecha reservadas hasta " . $fecha . ". Intente con una fecha superior.");
            }
        }

        //logica de quitar sabado domingos y feriados
        $i = 0;
        $fechaFin = Carbon::createFromFormat('Y-m-d',  $fechaForm);

        while ($i < $cantidad) {
            if ($fechaFin->dayOfWeek == Carbon::SUNDAY || $fechaFin->dayOfWeek == Carbon::SATURDAY) {
                $fechaFin = $fechaFin->addDay();
            } else {
                $i += 1;
                if ($i < $cantidad) {
                    $fechaFin = $fechaFin->addDay();
                }
            }
        }
        $calendario = new Calendario();
        $calendario->cantidad = $cantidad;
        $calendario->fechaInicio = $fechaForm;
        $calendario->fechaFin = $fechaFin->format('Y-m-d');
        $calendario->estado = false;
        $calendario->save();
        return redirect('admin/calendario');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function show(Calendario $calendario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendario $calendario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendario $calendario)
    {
        $calendario->delete();
        return redirect('admin/calendario');
    }
}
