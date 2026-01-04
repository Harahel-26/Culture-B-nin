<?php

namespace App\Http\Controllers\Front\Contributeur;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Langue;
use App\Models\Region;
use App\Models\TypeContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContenuController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:contributeur']);
    }

    /* ===============================
     * LISTE DES CONTENUS
     * =============================== */
    public function index()
    {
        $contenus = Contenu::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('front.contributeur.contenus.index', compact('contenus'));
    }

    /* ===============================
     * FORMULAIRE DE CRÉATION
     * =============================== */
    public function create()
    {
        return view('front.contributeur.contenus.create', [
            'langues' => Langue::all(),
            'regions' => Region::all(),
            'typecontenus' => TypeContenu::all(),
        ]);
    }

    /* ===============================
     * ENREGISTREMENT
     * =============================== */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'langue_id' => 'required|exists:langues,id',
            'typecontenu_id' => 'required|exists:typecontenus,id',
            'description' => 'nullable|string',
            'contenu_texte' => 'nullable|string',
        ]);

        Contenu::create([
            'titre' => $request->titre,
            'slug' => Str::slug($request->titre) . '-' . uniqid(),
            'description' => $request->description,
            'contenu_texte' => $request->contenu_texte,
            'langue_id' => $request->langue_id,
            'region_id' => $request->region_id,
            'typecontenu_id' => $request->typecontenu_id,
            'user_id' => auth()->id(),
            'status' => 'pending',
            'is_active' => true,
        ]);

        return redirect()
            ->route('contributeur.contenus.index')
            ->with('success', 'Contenu soumis et en attente de validation.');
    }

    /* ===============================
     * AFFICHER UN CONTENU
     * =============================== */
    public function show(Contenu $contenu)
    {
        $this->authorizeOwner($contenu);

        return view('front.contributeur.contenus.show', compact('contenu'));
    }

    /* ===============================
     * FORMULAIRE D’ÉDITION
     * =============================== */
    public function edit(Contenu $contenu)
    {
        $this->authorizeOwner($contenu);

        return view('front.contributeur.contenus.edit', [
            'contenu' => $contenu,
            'langues' => Langue::all(),
            'regions' => Region::all(),
            'typecontenus' => TypeContenu::all(),
        ]);
    }

    /* ===============================
     * MISE À JOUR
     * =============================== */
    public function update(Request $request, Contenu $contenu)
    {
        $this->authorizeOwner($contenu);

        $request->validate([
            'titre' => 'required|string|max:255',
            'langue_id' => 'required|exists:langues,id',
            'typecontenu_id' => 'required|exists:typecontenus,id',
            'description' => 'nullable|string',
            'contenu_texte' => 'nullable|string',
        ]);

        $contenu->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'contenu_texte' => $request->contenu_texte,
            'langue_id' => $request->langue_id,
            'region_id' => $request->region_id,
            'typecontenu_id' => $request->typecontenu_id,
            'status' => 'pending', // repasse en validation
        ]);

        return redirect()
            ->route('contributeur.contenus.index')
            ->with('success', 'Contenu modifié. Il sera revalidé.');
    }

    /* ===============================
     * SUPPRESSION
     * =============================== */
    public function destroy(Contenu $contenu)
    {
        $this->authorizeOwner($contenu);

        $contenu->delete();

        return redirect()
            ->route('contributeur.contenus.index')
            ->with('success', 'Contenu supprimé avec succès.');
    }

    /* ===============================
     * SÉCURITÉ : PROPRIÉTAIRE
     * =============================== */
    private function authorizeOwner(Contenu $contenu)
    {
        if ($contenu->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
