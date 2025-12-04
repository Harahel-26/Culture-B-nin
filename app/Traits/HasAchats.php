<?php

namespace App\Traits;

use App\Models\Contenu;
use App\Models\Paiement;

trait HasAchats
{
    public function contenusAchetes()
    {
        return $this->belongsToMany(Contenu::class, 'paiements')
                    ->wherePivot('statut', 'paye');
    }

    public function aAcheteContenu($contenuId)
    {
        return $this->contenusAchetes()->where('contenu_id', $contenuId)->exists();
    }

    public function acheterContenu(Contenu $contenu, $methode = 'mobile_money')
    {
        $paiement = Paiement::create([
            'user_id' => $this->id,
            'contenu_id' => $contenu->id,
            'montant' => $contenu->prix,
            'methode' => $methode,
            'statut' => 'en_attente',
            'metadata' => [
                'user_email' => $this->email,
                'contenu' => $contenu->titre,
            ]
        ]);

        $paiement->genererReference();

        return $paiement;
    }
}
