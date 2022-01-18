<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rol = ["A", "S"];
        return [
            'name' => $this->faker->name(),
            'matricula' => $this->faker->unique()->numerify("########"),
            'apellidoPaterno' => $this->faker->lastName,
            'apellidoMaterno' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->numerify("7#######"),
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'rol' => $rol[array_rand($rol)],
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
