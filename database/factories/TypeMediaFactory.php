<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TypeMedia;

class TypeMediaFactory extends Factory
{
    protected $model = TypeMedia::class;

    public function definition()
    {
        $types = ['image', 'audio', 'video', 'pdf', 'texte', 'document', 'archive'];

        return [
            'nom' => $this->faker->unique()->randomElement($types),
        ];
    }
}
