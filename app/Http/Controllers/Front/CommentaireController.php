<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Commentaire;
use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    /**
     * Enregistrer un nouveau commentaire
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'contenu_id' => 'required|exists:contenus,id',
            'commentaire' => 'required|string|min:3|max:1000',
            'note' => 'required|integer|min:1|max:5',
        ]);

        // Vérifie si le contenu existe
        $contenu = Contenu::findOrFail($validated['contenu_id']);

        // Pour les contenus premium, vérifie si l'utilisateur a acheté
        if ($contenu->is_premium) {
            $user = Auth::user();
            if (!$user->hasRole(['admin', 'moderateur']) &&
                !$contenu->estAchetePar($user)) {
                return redirect()->back()
                    ->with('error', 'Vous devez acheter ce contenu pour le commenter.');
            }
        }

        // Crée le commentaire
        Commentaire::create([
            'contenu_id' => $validated['contenu_id'],
            'user_id' => Auth::id(),
            'commentaire' => $validated['commentaire'],
            'note' => $validated['note'],
            'statut' => 'pending', // En attente de modération
        ]);

        // Redirection avec message de succès
        return redirect()->back()
            ->with('success', 'Votre commentaire a été soumis. Il sera publié après modération.');
    }

    /**
     * Supprimer un commentaire
     */
    public function destroy($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $user = Auth::user();

        // Vérifie que l'utilisateur peut supprimer ce commentaire
        $canDelete = $commentaire->user_id === $user->id ||
                     $user->hasRole(['admin', 'moderateur']);

        if (!$canDelete) {
            return redirect()->back()
                ->with('error', 'Vous n\'avez pas la permission de supprimer ce commentaire.');
        }

        $commentaire->delete();

        return redirect()->back()
            ->with('success', 'Commentaire supprimé avec succès!');
    }
}
