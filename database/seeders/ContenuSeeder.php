<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contenu;

class ContenuSeeder extends Seeder
{
    public function run()
    {
        // crée 15 contenus de test
        Contenu::factory()->count(15)->create();
    }
}
