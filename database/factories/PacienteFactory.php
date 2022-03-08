<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'matricula' => $this->faker->unique()->numberBetween(111111, 99999999999),
            'nombre' => $this->faker->name,
            'apellidoPaterno' => $this->faker->lastName,
            'apellidoMaterno' => $this->faker->lastName,
            'telefono' => $this->faker->phoneNumber,
            'correo' => $this->faker->email,
            'estado' => $this->faker->boolean,
        ];
    }
}
