<?php

namespace Database\Seeders;

use App\Models\Paquete;
use Illuminate\Database\Seeder;

class PaqueteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paquete = [
            "Reserva",
            "Laboratorios",
            "Configuración",
            "Usuarios",
            //"Temas",
            "Contraseña"
        ];

        $icon = [
            "fas fa-calendar-alt",
            "fas fa-flask",
            " fas fa-fw fa fa-cog",
            "fa-fw fas fa-users-cog",
            /*"fas fa-fw fa fa-paint-brush",*/
            "fas fa-user-lock"
        ];

        for ($i = 0; $i < count($paquete); $i++) {
            $pa = new Paquete();
            $pa->nombre = $paquete[$i];
            $pa->icon = $icon[$i];
            $pa->save();
        }
    }
}
