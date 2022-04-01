<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendario;
use App\Models\Cupo;
use App\Models\DetalleCalendario;
use App\Models\Grupo;
use App\Traits\RangeDate;
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
}
