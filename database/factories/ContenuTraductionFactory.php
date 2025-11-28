<?php

namespace Database\Factories;

use App\Models\Contenu;
use App\Models\Langue;
use App\Models\User;
use App\Models\ContenuTraduction;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContenuTraductionFactory extends Factory
{
    protected $model = ContenuTraduction::class;

    public function definition(): array
    {
        return [
            'contenu_id' => Contenu::inRandomOrder()->first()->id ?? Contenu::factory(),
            'langue_id' => Langue::inRandomOrder()->first()->id ?? Langue::factory(),

            'traduit_par' => User::inRandomOrder()->first()->id ?? User::factory(),

            'titre' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'contenu_texte' => $this->faker->paragraphs(3, true),

            'status' => 'pending',

            'validated_by' => null,
        ];
    }
}
