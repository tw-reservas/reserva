<?php

namespace Database\Seeders;

use App\Models\Cupo;
use App\Models\Grupo;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $grupos = [
            'grupo A', 'grupo B', 'grupo C'
        ];
        $porcentaje = [
            50, 40, 30
        ];

        $rangoInicio = ['06:00', '07:00', '08:00'];
        $rangoFin = ['07:00', '08:00', '09:00'];
        for ($i = 0; $i < 3; $i++) {
            $grupo = new Grupo();
            $grupo->nombre = $grupos[$i];
            $grupo->porcentaje = $porcentaje[$i];
            $grupo->horaInicio = $rangoInicio[$i];
            $grupo->horaFin = $rangoFin[$i];
            $grupo->estado = true;
            $grupo->save();
        }
    }
}
