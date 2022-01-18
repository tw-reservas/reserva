<?php

namespace Database\Seeders;

use App\Models\DetalleOrdenLab;
use Illuminate\Database\Seeder;

class DetalleOrdenLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetalleOrdenLab::factory()->count(100)->create();
    }
}
