<?php

namespace Database\Seeders;

use App\Models\Calendario;
use App\Models\Cupo;
use App\Models\DetalleCalendario;
use App\Models\Grupo;
use App\Models\GrupoCalendario;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DetalleCalendarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $calendario = Calendario::all()->last();
        $grupos = Grupo::all();
        $cupo = Cupo::all()->last();
        for ($i = 0; $i < $calendario->cantidad; $i++) {
            $fecha = Carbon::parse($calendario->fechaInicio)->addDays($i)->format('Y-m-d');
            for ($j = 0; $j < sizeof($grupos); $j++) {
                $horario = new DetalleCalendario();
                $horario->fecha = $fecha;
                $horario->cupoOcupado = 0;
                $horario->cupoMaximo = intval($cupo->total * ($grupos[$j]->porcentaje / 100));
                $horario->estado = true;
                $horario->grupo_id = $grupos[$j]->id;
                $horario->calendario_id = $calendario->id;
                $horario->cupo_id = $cupo->id;
                $horario->save();
            }
        }
    }
}
