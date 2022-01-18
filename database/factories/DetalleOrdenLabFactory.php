<?php

namespace Database\Factories;

use App\Models\Laboratorio;
use App\Models\Ordenlab;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleOrdenLabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'laboratorio_id' => Laboratorio::all()->random()->id,
            'ordenlab_id' => Ordenlab::all()->random()->id,
        ];
    }
}
