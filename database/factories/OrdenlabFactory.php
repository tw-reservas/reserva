<?php

namespace Database\Factories;

use App\Models\Paciente;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdenlabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => strval($this->faker->numberBetween(1000000, 99999999)),
            'fecha' => Carbon::now()->format('y-M-d'),
            'paciente_id' => Paciente::all()->random()->id,
        ];
    }
}
