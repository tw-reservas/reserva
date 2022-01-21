<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol1 = new Rol();
        $rol1->nombre = "jefe de laboratorio";
        $rol1->abreviado = "jl";
        $rol1->save();


        $rol2 = new Rol();
        $rol2->nombre = "secretaria";
        $rol2->abreviado = "s";
        $rol2->save();
    }
}
