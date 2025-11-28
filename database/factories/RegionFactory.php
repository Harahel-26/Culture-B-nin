<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Region;

class RegionFactory extends Factory
{
    protected $model = Region::class;

    public function definition()
    {
        $types = ['Département', 'Commune', 'Village'];
        $codesLangues = ['fon', 'yor', 'gou', 'bar', 'den'];

        return [
            'nom' => $this->faker->unique()->city(),
            'type' => $this->faker->randomElement($types),
            'langue_principale' => $this->faker->randomElement($codesLangues),
            'description' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }
}
