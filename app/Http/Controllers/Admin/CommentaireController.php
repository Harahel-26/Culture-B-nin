<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    /**
     * Afficher la liste des commentaires avec filtres
     */
    public function index(Request $request)
    {
        $query = Commentaire::with(['contenu', 'utilisateur'])
            ->orderBy('created_at', 'desc');

        // Filtre par statut
        if ($request->has('statut')) {
            $query->where('statut', $request->statut);
        }

        $commentaires = $query->paginate(20);

        $stats = [
            'total' => Commentaire::count(),
            'pending' => Commentaire::where('statut', 'pending')->count(),
            'validated' => Commentaire::where('statut', 'validated')->count(),
            'rejected' => Commentaire::where('statut', 'rejected')->count(),
        ];

        return view('admin.commentaires.index', compact('commentaires', 'stats'));
    }

    /**
     * Valider un commentaire
     */
    public function valider($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->update(['statut' => 'validated']);

        return redirect()->route('admin.commentaires.index')
            ->with('success', 'Commentaire validé avec succès.');
    }

    /**
     * Rejeter un commentaire
     */
    public function rejeter($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->update(['statut' => 'rejected']);

        return redirect()->route('admin.commentaires.index')
            ->with('success', 'Commentaire rejeté.');
    }

    /**
     * Supprimer un commentaire (admin)
     */
    public function destroy($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->delete();

        return redirect()->route('admin.commentaires.index')
            ->with('success', 'Commentaire supprimé définitivement.');
    }

    /**
     * Voir les détails d'un commentaire
     */
    public function show($id)
    {
        $commentaire = Commentaire::with(['contenu', 'utilisateur'])->findOrFail($id);

        return view('admin.commentaires.show', compact('commentaire'));
    }
}
