<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Paiement;

class PaiementController extends Controller
{
    public function init(Contenu $contenu)
    {
        return view('front.paiement.init', compact('contenu'));
    }

    public function process(Contenu $contenu)
    {
        $paiement = auth()->user()->acheterContenu($contenu);

        return redirect()->route('front.paiement.success', $paiement->reference);
    }

    public function success($reference)
    {
        $paiement = Paiement::where('reference', $reference)->firstOrFail();

        $paiement->update([
            'statut' => 'paye',
            'paye_le' => now()
        ]);

        return view('front.paiement.success', compact('paiement'));
    }

    public function failed($reference)
    {
        return view('front.paiement.failed', compact('reference'));
    }
}
