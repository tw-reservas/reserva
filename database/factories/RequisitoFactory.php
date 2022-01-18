<?php

namespace Database\Factories;

use App\Models\Requisito;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequisitoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Requisito::class;
    public function definition()
    {
        return [
            'descripcion' => $this->faker->sentence(5),
        ];
    }
}
