<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\DemandeContributeur;
use Illuminate\Http\Request;

class DemandeContributeurController extends Controller
{
    public function form()
    {
        $demande = DemandeContributeur::where('user_id', auth()->id())->first();

        return view('front.profil.devenir-contributeur', compact('demande'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'motivation' => 'nullable|min:10'
        ]);

        // Empêcher une seconde demande
        if (DemandeContributeur::where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'Vous avez déjà soumis une demande.');
        }

        DemandeContributeur::create([
            'user_id' => auth()->id(),
            'motivation' => $request->motivation,
        ]);

        return back()->with('success', 'Votre demande a été envoyée. Elle sera examinée par l\'équipe.');
    }
}
