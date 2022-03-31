<?php

namespace Database\Seeders;

use App\Models\DiaFestivo;
use Illuminate\Database\Seeder;

class DiaFestivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $feriados = [
            ["titulo" => "año nuevo", "fecha" => "2020-01-01"],
            ["titulo" => "dia del estado plurinacional", "fecha" => "2020-01-22"],
            ["titulo" => "viernes santo", "fecha" => "2020-04-15"],
            ["titulo" => "dia del trabajo", "fecha" => "2020-05-01"],
            ["titulo" => "corpus christi", "fecha" => "2020-06-16"],
            ["titulo" => "año nuevo aymara", "fecha" => "2020-06-21"],
            ["titulo" => "dia de la independencia", "fecha" => "2020-08-06"],
            ["titulo" => "Dia de los difuntos", "fecha" => "2020-11-2"],
            ["titulo" => "Navidad", "fecha" => "2020-12-25"],
        ];
        DiaFestivo::insert($feriados);
    }
}
