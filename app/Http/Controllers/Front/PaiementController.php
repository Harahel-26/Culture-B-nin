<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Contenu;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function callback(Request $request)
    {
        $contenuId = $request->contenu_id;
        $transactionId = $request->transaction_id ?? $request->id;

        // Vérifier que l’utilisateur est bien connecté
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        // Vérifier contenu
        $contenu = Contenu::findOrFail($contenuId);

        // Enregistrer le paiement en base
        Paiement::create([
            'reference'   => $transactionId,
            'user_id'     => auth()->id(),
            'contenu_id'  => $contenu->id,
            'montant'     => $contenu->prix,
            'devise'      => 'XOF',
            'gateway'     => 'kkiapay',
            'statut'      => 'paye',
            'paye_le'     => now(),
        ]);

        return redirect()
                ->route('front.contenus.show', $contenu->slug)
                ->with('success', 'Paiement confirmé ! Vous avez maintenant accès au contenu.');
    }
}
