<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\User;
use App\Models\Contenu;
use App\Models\TypeMedia;

use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition()
    {
        return [
            'contenu_id' => Contenu::inRandomOrder()->first()->id ?? 1,
            'type_media_id' => TypeMedia::inRandomOrder()->first()->id ?? 1,
            'langue_id' => null,
            'titre' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'fichier' => 'medias/test.jpg',
            'extension' => 'jpg',
            'taille' => rand(50, 5000),
            'upload_par' => User::first()->id ?? 1,
            'status' => 'validated'
        ];
    }
}
