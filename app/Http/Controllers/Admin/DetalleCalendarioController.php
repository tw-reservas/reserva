<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendario;
use App\Models\Cupo;
use App\Models\DetalleCalendario;
use App\Models\DetalleReserva;
use App\Models\Grupo;
use App\Traits\RangeDate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DetalleCalendarioController extends Controller
{
    use RangeDate;
    public function index()
    {
        $calendarios = Calendario::all()->sortBy('estado');
        $grupos = Grupo::where("estado", true)->get();
        $cupo = Cupo::where("estado", true)->first();
        $sumaDeCupo = 0;
        foreach ($grupos as $key => $value) {
            $sumaDeCupo += $value->porcentaje;
        }
        return view('admin.detalle-calendario.index')
            ->with('calendarios', $calendarios)
            ->with('grupos', $grupos)
            ->with('cupo', $cupo)->with('sumaCupo', $sumaDeCupo);
    }

    public function repartir(Calendario $calendario, Cupo $cupo)
    {
        if ($calendario->detalle_calendario_count > 0 || $calendario->estado) {
            return redirect()->back()->with('error', "Calendario activado");
        }
        $detalleCalendario = $this->getListDates($calendario->fechaInicio, $calendario->fechaFin, $calendario->id);
        DB::beginTransaction();
        try {
            $calendario->estado =   !$calendario->estado;
            $calendario->activado = true;
            $calendario->update();
            //$calendario->detalleCalendario()->createMany($detalleCalendario);
            DetalleCalendario::insert($detalleCalendario);
            DB::commit();
            return redirect()->back()->with('success', "Cupos Repartidos con éxitos");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', "Ocurrio un error al insertar a la base de datos, intente mas tarde");
        }
    }

    public function verDetalles(Calendario $calendario)
    {
        $detalle = $calendario->detalleCalendario()->with('grupo:id,nombre')->orderBy("id")->get();
        //dd($detalle);
        return view('admin.detalle-calendario.ver-detalle')->with('detalles', $detalle)->with('calendario', $calendario);
    }

    public function showPageDetalleCalendarioDisable(Calendario $calendario)
    {
        $detalles = $calendario->detalleCalendario()
            ->where('estado', true)
            ->select('fecha')
            ->selectRaw('sum("cupoOcupado") as cupoOcupado')
            ->selectRaw('sum("cupoMaximo") as cupoMaximo ')
            ->selectRaw('max("id") as id')
            ->groupBy(['fecha'])->get();
        return view('admin.detalle-calendario.ver-detalle-disable', compact('detalles'))->with('calendario', $calendario);
    }

    private function diffDateWithNow($date)
    {
        $now = Carbon::now();
        $date = Carbon::parse($date);
        $now->setTime(0, 0, 0);
        $date->setTime(0, 0, 0);
        return $date->diffInDays($now, false);
    }

    public function detalleCalendarioDisable($fecha)
    {
        if ($this->diffDateWithNow($fecha) >= 0) {
            return back()->with('error', "La fecha debe ser superior a la fecha actual");
        }
        DB::beginTransaction();
        try {
            $detalles = DetalleCalendario::whereDate('fecha', $fecha)
                ->where("estado", true)
                ->with('reserva')->get();
            foreach ($detalles as  $detalle) {
                $detalle->reserva()->delete();
            }
            $detalles = DetalleCalendario::whereDate('fecha', $fecha)
                ->where("estado", true)
                ->update(["estado" => false]);
            DB::commit();
            return back()->with('success', "Fecha deshabilitada con éxito");
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return back()->with('success', "Fecha deshabilitada con éxito");
        }
    }
}
