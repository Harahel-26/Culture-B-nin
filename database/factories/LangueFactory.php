<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LangueFactory extends Factory
{
    protected $model = \App\Models\Langue::class;

    public function definition()
    {
        return [
            'code' => strtolower($this->faker->unique()->lexify('???')),
            'nom' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }
}
