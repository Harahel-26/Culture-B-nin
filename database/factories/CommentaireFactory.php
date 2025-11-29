<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Contenu;
use App\Models\Commentaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentaireFactory extends Factory
{
    protected $model = Commentaire::class;

    public function definition()
    {
        return [
            'contenu_id' => Contenu::inRandomOrder()->first()->id ?? Contenu::factory(),
            'user_id'    => User::inRandomOrder()->first()->id ?? User::factory(),
            'note'       => $this->faker->numberBetween(1, 5),
            'commentaire'=> $this->faker->paragraph(),
            'parent_id'  => null,   // On génère d’abord les parents
            'statut'     => $this->faker->randomElement(['pending', 'validated', 'rejected']),
        ];
    }
}
