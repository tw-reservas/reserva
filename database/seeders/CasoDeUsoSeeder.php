<?php

namespace Database\Seeders;

use App\Models\CasoDeUso;
use Illuminate\Database\Seeder;

class CasoDeUsoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nombre = [
            "Programar reserva",
            "Ver Reserva",
            "Administrar laboratorio",
            "Administrar Area",
            "Administrar requisitos",
            "Administrar Grupo",
            "Administrar Cupo",
            "Adm. Calendario",
            "Detalle Calendario",
            "Registrar usuario",
            "Administrar rol",
            "Recuperar contraseña",
            "Adm. privilegios",
            "Conf. temas"
        ];

        $url = [
            "/admin/reserva",
            "/admin/ver",
            "/admin/laboratorios",
            "/admin/areas",
            "/admin/requisitos",
            "/admin/grupo",
            "/admin/cupo",
            "/admin/calendario",
            "/admin/detalle-calendario",
            "/admin/user",
            "/admin/rol",
            "#",
            "#",
            "/admin/theme"
        ];

        $paquete_id = [
            1, 1, 2, 2, 2, 3, 3, 3, 3, 4, 4, 4, 4, 5
        ];

        for ($i = 0; $i < count($nombre); $i++) {
            $caso = new CasoDeUso();
            $caso->nombre = $nombre[$i];
            $caso->url = $url[$i];
            $caso->paquete_id = $paquete_id[$i];
            $caso->icon = "";
            $caso->save();
        }
    }
}
