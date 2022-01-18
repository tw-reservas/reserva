<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CupoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => $this->faker->numberBetween(50, 200),
            'estado' => false,
        ];
    }
}
