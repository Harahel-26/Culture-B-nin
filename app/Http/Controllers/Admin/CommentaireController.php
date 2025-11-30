<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin|moderateur']);
    }

    // liste de tous les commentaires (avec filtres possibles)
    public function index(Request $request)
    {
        $query = Commentaire::with(['auteur','contenu']);

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $commentaires = $query->orderBy('created_at','desc')->paginate(20);

        return view('admin.commentaires.index', compact('commentaires'));
    }

    public function show(Commentaire $commentaire)
    {
        return view('admin.commentaires.show', compact('commentaire'));
    }

    // valider
    public function valider(Commentaire $commentaire)
    {
        $commentaire->update([
            'statut' => 'validated',
        ]);

        // option : notifier l'auteur ici (plus tard)
        return back()->with('success', 'Commentaire validé.');
    }

    // rejeter
    public function rejeter(Commentaire $commentaire)
    {
        $commentaire->update([
            'statut' => 'rejected',
        ]);

        return back()->with('success', 'Commentaire rejeté.');
    }

    public function destroy(Commentaire $commentaire)
    {
        $commentaire->delete();
        return back()->with('success', 'Commentaire supprimé.');
    }
}
