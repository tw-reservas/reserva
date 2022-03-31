<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarioRequest;
use App\Models\Calendario;
use App\Traits\RangeDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CalendarioController extends Controller
{
    use RangeDate;
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

    private function validateFechaInicio($fecha)
    {
        $now = Carbon::now()->format("Y-m-d");
        if ($fecha == $now) {
            return "La fecha debe ser mayor a " . $now;
        }
        if ($this->isSundaySaturdayHoliday(Carbon::parse($fecha))) {
            return "No se puede reservar en este dia: feriado o fin de semana";
        }
        $fechaMax = Calendario::max('fechaFin');
        if (!is_null($fechaMax)) {
            if ($fecha <= $fechaMax) {
                return "Fecha reservadas hasta " . $fechaMax . ". Intente con una fecha superior.";
            }
        }
        return "";
    }


    public function store(CalendarioRequest $request)
    {
        $cantidad = $request->cantidad;
        $fechaForm = Carbon::parse($request->fechaInicio)->format("Y-m-d");
        $errorMessage = $this->validateFechaInicio($request->fechaInicio);
        if ($errorMessage != "") {
            return back()->with("error", $errorMessage);
        }
        //lógica de quitar sábado domingos y feriados
        $fechaFin = Carbon::createFromFormat('Y-m-d',  $fechaForm);
        $this->lastDate($fechaFin, $cantidad);

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
