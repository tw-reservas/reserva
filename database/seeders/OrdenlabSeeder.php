<?php

namespace Database\Seeders;

use App\Models\Ordenlab;
use Illuminate\Database\Seeder;

class OrdenlabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ordenlab::factory()->count(20)->create();
    }
}
