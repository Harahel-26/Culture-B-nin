<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commentaire;
use App\Models\Contenu;

class CommentaireSeeder extends Seeder
{
    public function run()
    {
        // Générer 50 commentaires simples
        Commentaire::factory(50)->create();

        // Générer quelques réponses (commentaires imbriqués)
        $parents = Commentaire::inRandomOrder()->take(10)->get();

        foreach ($parents as $parent) {
            Commentaire::factory(rand(1,3))->create([
                'parent_id' => $parent->id,
                'contenu_id'=> $parent->contenu_id, // même contenu
            ]);
        }
    }
}
