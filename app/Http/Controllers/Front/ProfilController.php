<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Commentaire;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Afficher le profil de l'utilisateur
     */
    public function index()
    {
        $user = Auth::user();

        // Statistiques
        $stats = [
            'contenus' => $user->contenus()->count(),
            'commentaires' => $user->commentaires()->count(),
            'contenus_achetes' => $user->contenusAchetes()->count(),
        ];

        // Derniers contenus créés
        $derniersContenus = $user->contenus()
            ->with(['langue', 'region', 'typecontenu'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Derniers commentaires
        $derniersCommentaires = $user->commentaires()
            ->with('contenu')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Derniers achats
        $derniersAchats = $user->contenusAchetes()
            ->orderBy('pivot_created_at', 'desc')
            ->take(5)
            ->get();

        return view('front.profil.index', compact('user', 'stats', 'derniersContenus', 'derniersCommentaires', 'derniersAchats'));
    }

    /**
     * Afficher le formulaire d'édition du profil
     */
    public function edit()
    {
        $user = Auth::user();
        return view('front.profil.edit', compact('user'));
    }

    /**
     * Mettre à jour le profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|max:2048',
        ]);

        // Mettre à jour les informations
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'bio' => $validated['bio'] ?? null,
        ]);

        // Gérer l'avatar
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->update(['avatar' => $path]);
        }

        return redirect()->route('front.profil.index')
            ->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Afficher les contenus de l'utilisateur
     */
    public function contenus()
    {
        $user = Auth::user();
        $contenus = $user->contenus()
            ->with(['langue', 'region', 'typecontenu'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('front.profil.contenus', compact('user', 'contenus'));
    }

    /**
     * Afficher les commentaires de l'utilisateur
     */
    public function commentaires()
    {
        $user = Auth::user();
        $commentaires = $user->commentaires()
            ->with('contenu')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('front.profil.commentaires', compact('user', 'commentaires'));
    }

    /**
     * Afficher les traductions de l'utilisateur
     */
    public function traductions()
    {
        $user = Auth::user();

        // Si tu as un modèle ContenuTraduction
        if (class_exists('App\Models\ContenuTraduction')) {
            $traductions = $user->traductions()
                ->with('contenu')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $traductions = collect();
        }

        return view('front.profil.traductions', compact('user', 'traductions'));
    }

    /**
     * Soumettre une demande pour devenir contributeur
     */
    public function demandeContributeur(Request $request)
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur a déjà une demande en attente
        if (class_exists('App\Models\DemandeContributeur')) {
            $demandeExistante = \App\Models\DemandeContributeur::where('user_id', $user->id)
                ->whereIn('statut', ['pending', 'approved'])
                ->exists();

            if ($demandeExistante) {
                return redirect()->route('front.profil.index')
                    ->with('error', 'Vous avez déjà une demande en cours.');
            }
        }

        // Logique pour créer une demande
        // À adapter selon ton modèle DemandeContributeur

        return redirect()->route('front.profil.index')
            ->with('success', 'Votre demande a été soumise avec succès.');
    }
}
