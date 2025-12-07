<?php

namespace App\Http\Controllers\Moderateur;

use App\Http\Controllers\Controller;
use App\Models\Contenu;

class ContenuModerationController extends Controller
{
    public function index()
    {
        $contenus = Contenu::where('status','pending')
            ->with('utilisateur', 'langue', 'typecontenu')
            ->paginate(15);

        return view('moderateur.contenus.index', compact('contenus'));
    }

    public function valider(Contenu $contenu)
    {
        $contenu->update([
            'status' => 'validated',
            'validated_by' => auth()->id(),
        ]);

        return back()->with('success', 'Contenu validé.');
    }

    public function rejeter(Contenu $contenu)
    {
        $contenu->update([
            'status' => 'rejected',
            'validated_by' => auth()->id(),
        ]);

        return back()->with('success', 'Contenu rejeté.');
    }
}
