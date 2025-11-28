<?php

namespace App\Http\Controllers;

use App\Models\DemandeContributeur;
use Illuminate\Http\Request;

class DemandeContributeurUserController extends Controller
{
    public function form()
    {
        // Si une demande est déjà en attente → pas le droit d'en refaire
        $existe = DemandeContributeur::where('user_id', auth()->id())
                    ->where('status', 'pending')
                    ->first();

        return view('user.demande.form', compact('existe'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'motif' => 'required|min:10',
        ]);

        // Vérifier si une demande est déjà en attente
        $deja = DemandeContributeur::where('user_id', auth()->id())
                    ->where('status', 'pending')
                    ->exists();

        if ($deja) {
            return back()->with('error', "Votre demande est déjà en attente.");
        }

        DemandeContributeur::create([
            'user_id' => auth()->id(),
            'motif' => $request->motif,
            'status' => 'pending'
        ]);

        return redirect()->route('demande.mes')
            ->with('success', 'Votre demande a été envoyée.');
    }

    public function mesDemandes()
    {
        $demandes = DemandeContributeur::where('user_id', auth()->id())
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('user.demande.mes', compact('demandes'));
    }
}
