<?php

namespace App\Http\Controllers\Moderateur;

use App\Http\Controllers\Controller;
use App\Models\Commentaire;

class CommentaireModerationController extends Controller
{
    public function index()
    {
        $commentaires = Commentaire::where('statut', 'pending')
            ->with(['contenu', 'utilisateur'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('moderateur.commentaires.index', compact('commentaires'));
    }

    public function valider(Commentaire $commentaire)
    {
        $commentaire->update([
            'statut' => 'validated'
        ]);

        return back()->with('success', 'Commentaire validé.');
    }

    public function rejeter(Commentaire $commentaire)
    {
        $commentaire->update([
            'statut' => 'rejected'
        ]);

        return back()->with('success', 'Commentaire rejeté.');
    }
}
