<?php

namespace Database\Factories;

use App\Models\Calendario;
use App\Models\Cupo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $cantidad = $this->faker->numberBetween(10, 20);
        $fechaInicio = Carbon::now();
        return [
            'cantidad' => $cantidad,
            'fechaInicio' => $fechaInicio->format('Y-m-d'),
            'fechaFin' => $fechaInicio->addDays($cantidad),
            'estado' => false,
        ];
    }
}
