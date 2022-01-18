<?php

namespace Database\Seeders;

use App\Models\Cupo;
use Illuminate\Database\Seeder;

class CupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cupo::factory()->count(3)->create();
    }
}
