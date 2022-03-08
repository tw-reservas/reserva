<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendario;
use App\Models\Cupo;
use App\Models\DetalleCalendario;
use App\Models\Grupo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class DetalleCalendarioController extends Controller
{
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

    private function getListDates($fechaInicio, $fechaFin, $grupos, $cupo_id, $calendario_id)
    {
        $start = Carbon::createFromFormat('Y-m-d', $fechaInicio);
        $end = Carbon::createFromFormat('Y-m-d', $fechaFin);
        $diaGrupo = [];
        for ($i = $start; $i <= $end; $i->addDay()) {
            if ($i->dayOfWeek == Carbon::SUNDAY || $i->dayOfWeek == Carbon::SATURDAY) {
            } else {
                foreach ($grupos as $grupo => $value) {
                    $diaGrupo[] = [
                        "cupoMaximo" => $value->porcentaje,
                        "cupoOcupado" => 0,
                        "fecha" => $i->format('Y-m-d'),
                        "estado" => true,
                        "cupo_id" => $cupo_id,
                        "grupo_id" => $value->id,
                        "calendario_id" => $calendario_id,
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now(),
                    ];
                }
            }
        }
        return $diaGrupo;
    }

    public function repartir(Calendario $calendario, Cupo $cupo)
    {
        if ($calendario->detalleCalendario()->first() != null || $calendario->estado) {
            return redirect()->back()->with('error', "Calendario activado");
        }
        $grupos = Grupo::select(['id', 'porcentaje'])->where("estado", true)->orderBy('id')->get();
        $diaGrupo = $this->getListDates($calendario->fechaInicio, $calendario->fechaFin, $grupos, $cupo->id, $calendario->id);
        DB::beginTransaction();
        try {

            $calendario->estado =   !$calendario->estado;
            $calendario->activado = true;
            $calendario->update();
            DetalleCalendario::insert($diaGrupo);
            DB::commit();
            return redirect()->back()->with('success', "Cupos Repartidos con éxitos");
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return redirect()->back()->with('error', "Ocurrio un error al insertar a la base de datos, intente mas tarde");
        }
    }

    public function verDetalles(Calendario $calendario)
    {
        $detalle = $calendario->detalleCalendario()->with('grupo:id,nombre')->get();
        //dd($detalle);
        return view('admin.detalle-calendario.ver-detalle')->with('detalles', $detalle)->with('calendario', $calendario);
    }
}
