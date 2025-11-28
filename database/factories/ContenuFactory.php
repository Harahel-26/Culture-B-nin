<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contenu;
use App\Models\User;
use App\Models\Langue;
use App\Models\Region;
use App\Models\TypeContenu;
use Illuminate\Support\Str;

class ContenuFactory extends Factory
{
    protected $model = Contenu::class;

    public function definition()
    {
        $titre = $this->faker->sentence(5);

        return [
            'titre' => $titre,
            'slug' => Str::slug($titre) . '-' . uniqid(),
            'description' => $this->faker->paragraph(),
            'contenu_texte' => $this->faker->paragraphs(3, true),
            'image_couverture' => null,

            'langue_id' => Langue::inRandomOrder()->value('id'),
            'region_id' => Region::inRandomOrder()->value('id'),
            'typecontenu_id' => TypeContenu::inRandomOrder()->value('id'),
            'user_id' => User::inRandomOrder()->value('id'),

            'validated_by' => null,
            'status' => 'pending',
            'is_active' => true,
        ];
    }
}
