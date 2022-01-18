<?php

namespace Database\Seeders;

use App\Models\Calendario;
use Illuminate\Database\Seeder;

class CalendarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Calendario::factory()->count(1)->create();
    }
}
