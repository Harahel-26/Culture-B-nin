<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\DemandeRole;
use Illuminate\Http\Request;

class ContributeurDemandeController extends Controller
{
    public function form()
    {
        return view('front.contributeur.demande');
    }

    public function submit(Request $request)
    {
        // Empêcher double demande
        if (auth()->user()->hasPendingContributeurRequest()) {
            return back()->with('error', 'Vous avez déjà une demande en attente.');
        }

        DemandeRole::create([
            'user_id' => auth()->id(),
            'role_demande' => 'contributeur',
            'motif' => $request->motif ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('front.profil.edit', auth()->user())
            ->with('success', 'Votre demande a été envoyée et sera examinée.');
    }
}
