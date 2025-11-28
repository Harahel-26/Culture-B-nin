<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\DemandeContributeur;
use Illuminate\Database\Eloquent\Factories\Factory;

class DemandeContributeurFactory extends Factory
{
    protected $model = DemandeContributeur::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'motif' => $this->faker->sentence(),
            'status' => 'pending',
            'validated_by' => null,
        ];
    }
}
