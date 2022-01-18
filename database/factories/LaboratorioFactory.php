<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Requisito;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaboratorioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->number_between(10000, 99999),
            'nombre' => $this->faker->sentence(3),
            'estado' => true,
            'requisito_id' => Requisito::all()->random(1)->first()->id,
            'area_cod' => Area::all()->random(1)->first()->codigo,
        ];
    }
}
