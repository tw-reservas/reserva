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
    }
}
