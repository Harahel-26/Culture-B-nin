<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TypeContenu;

class TypeContenuFactory extends Factory
{
    protected $model = TypeContenu::class;

    public function definition()
    {
        return [
            'nom' => ucfirst($this->faker->unique()->word()),
        ];
    }
}
