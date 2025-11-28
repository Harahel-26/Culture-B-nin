<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeContenu;

class TypeContenuSeeder extends Seeder
{
    public function run()
    {
        $types = [
            'Histoire',
            'Gastronomie',
            'Musique',
            'Danse',
            'Artisanat',
            'Contes',
            'Religions traditionnelles',
            'Personnalités',
            'Patrimoine',
        ];

        foreach ($types as $t) {
            TypeContenu::firstOrCreate(['nom' => $t]);
        }
    }
}
