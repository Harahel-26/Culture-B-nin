<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Traduction;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('front.profil.index', [
            'user' => $user,
            'contenus' => $user->contenus()->count(),
            'traductions' => $user->traductions()->count(),
            'commentaires' => $user->commentaires()->count(),
        ]);
    }

    public function edit()
    {
        return view('front.profil.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'required|email'
        ]);

        $user = auth()->user();
        $user->update($data);

        return back()->with('success', 'Profil mis à jour.');
    }

    public function contenus()
    {
        $contenus = auth()->user()->contenus()->latest()->paginate(10);
        return view('front.profil.contenus', compact('contenus'));
    }

    public function traductions()
    {
        $traductions = auth()->user()->traductions()->latest()->paginate(10);
        return view('front.profil.traductions', compact('traductions'));
    }

    public function commentaires()
    {
        $commentaires = auth()->user()->commentaires()->latest()->paginate(10);
        return view('front.profil.commentaires', compact('commentaires'));
    }

    // Demande pour devenir contributeur
    public function demandeContributeur()
    {
        $user = auth()->user();

        if ($user->hasRole('contributeur')) {
            return back()->with('info', 'Vous êtes déjà contributeur.');
        }

        // envoyée aux admins (plus tard : notification)
        $user->demande_contributeur = 1;
        $user->save();

        return back()->with('success', 'Votre demande a été envoyée aux administrateurs.');
    }
}
