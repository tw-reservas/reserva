<?php

namespace Database\Seeders;

use App\Models\CasoDeUso;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $caso = CasoDeUso::all();

        foreach ($caso as $key => $value) {
            $menu = new Menu();
            $menu->rol_id = 1;
            $menu->caso_de_uso_id = $value->id;
            $menu->save();
        }

        $casos_id = [1, 2, 3, 4, 5, 6, 12, 14, 15];

        for ($i = 0; $i < count($casos_id); $i++) {
            $menu = new Menu();
            $menu->rol_id = 2;
            $menu->caso_de_uso_id = $casos_id[$i];
            $menu->save();
        }
    }
}
