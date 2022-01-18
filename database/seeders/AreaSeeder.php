<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */



    public function run()
    {
        $ScriptArea = "INSERT INTO AREAs(cod_serv, Nombre)
        VALUES
        (1,'HEMATOLOGIA'),
        (2,'QUIMICA'),
        (3,'SEROLOGIA'),
        (4,'ORINA'),
        (5,'HECES'),
        (6,'BACTERIOLOGIA'),
        (7,'HORMONAS'),
        (8,'CONTROL PRENATAL'),
        (9,'CONTROL PREQUIRURGICO'),
        (10,'INGRESOS'),
        (11,'EGRESOS'),
        (12,'BIOLOGIA MOLECULAR')";
        //Area::factory()->count(50)->create();
        DB::statement($ScriptArea);
    }
}
