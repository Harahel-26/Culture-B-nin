<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Langue;
use App\Models\Region;
use App\Models\TypeContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContenuController extends Controller
{
    /**
     * Afficher la liste des contenus avec filtres
     */
    public function index(Request $request)
    {
        // Récupère seulement les contenus validés et actifs
        $query = Contenu::where('status', 'validated')
            ->where('is_active', true)
            ->with(['utilisateur' => function($q) {
                $q->where('is_active', true); // Utilisateurs actifs seulement
            }, 'langue', 'region', 'typecontenu']);

        // Filtres
        if ($request->has('langue_id')) {
            $query->where('langue_id', $request->langue_id);
        }

        if ($request->has('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        if ($request->has('typecontenu_id')) {
            $query->where('typecontenu_id', $request->typecontenu_id);
        }

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('contenu_texte', 'like', '%' . $request->search . '%');
            });
        }

        $contenus = $query->orderBy('created_at', 'desc')->paginate(12);

        // Données pour les filtres
        $langues = Langue::where('is_active', true)->get();
        $regions = Region::where('is_active', true)->get();
        $typecontenus = TypeContenu::where('is_active', true)->get();

        return view('front.contenus.index', compact('contenus', 'langues', 'regions', 'typecontenus'));
    }

    /**
     * Afficher un contenu spécifique
     */
    public function show($slug)
    {
        // Récupère le contenu avec toutes ses relations
        $contenu = Contenu::with([
            'utilisateur' => function($q) {
                $q->where('is_active', true); // Auteur actif seulement
            },
            'langue',
            'region',
            'typecontenu',
            'medias',
            'commentaires.utilisateur' => function($q) {
                $q->where('is_active', true); // Auteur de commentaire actif
            }
        ])->where('slug', $slug)
          ->where('is_active', true)
          ->firstOrFail();

        // Vérifie si l'utilisateur peut voir le contenu
        $canView = $this->canViewContent($contenu);

        // Suggestions de contenus similaires
        $contenusSimilaires = Contenu::where('status', 'validated')
            ->where('is_active', true)
            ->where('id', '!=', $contenu->id)
            ->where(function($query) use ($contenu) {
                $query->where('langue_id', $contenu->langue_id)
                      ->orWhere('region_id', $contenu->region_id)
                      ->orWhere('typecontenu_id', $contenu->typecontenu_id);
            })
            ->limit(4)
            ->get();

        return view('front.contenus.show', compact('contenu', 'canView', 'contenusSimilaires'));
    }

    /**
     * Vérifie si l'utilisateur peut voir le contenu
     */
    private function canViewContent($contenu)
    {
        // Si le contenu est gratuit
        if (!$contenu->is_premium) {
            return true;
        }

        // Si utilisateur non connecté
        if (!Auth::check()) {
            return false;
        }

        $user = Auth::user();

        // Vérifie que l'utilisateur est actif
        if (!$user->is_active) {
            return false;
        }

        // Si admin/moderateur
        if ($user->hasRole(['admin', 'moderateur'])) {
            return true;
        }

        // Si contributeur qui a acheté le contenu
        if ($user->hasRole('contributeur')) {
            return $contenu->estAchetePar($user);
        }

        // Si simple utilisateur qui a acheté le contenu
        return $contenu->estAchetePar($user);
    }

    /**
     * Liste des contenus par catégorie (type de contenu)
     */
    public function parCategorie($slug)
    {
        $typeContenu = TypeContenu::where('slug', $slug)->firstOrFail();

        $contenus = Contenu::where('status', 'validated')
            ->where('is_active', true)
            ->where('typecontenu_id', $typeContenu->id)
            ->with(['utilisateur' => function($q) {
                $q->where('is_active', true);
            }, 'langue', 'region'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('front.contenus.categorie', compact('contenus', 'typeContenu'));
    }

    /**
     * Liste des contenus par région
     */
    public function parRegion($slug)
    {
        $region = Region::where('slug', $slug)->firstOrFail();

        $contenus = Contenu::where('status', 'validated')
            ->where('is_active', true)
            ->where('region_id', $region->id)
            ->with(['utilisateur' => function($q) {
                $q->where('is_active', true);
            }, 'langue', 'typecontenu'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('front.contenus.region', compact('contenus', 'region'));
    }

    /**
     * Liste des contenus par langue
     */
    public function parLangue($code)
    {
        $langue = Langue::where('code', $code)->firstOrFail();

        $contenus = Contenu::where('status', 'validated')
            ->where('is_active', true)
            ->where('langue_id', $langue->id)
            ->with(['utilisateur' => function($q) {
                $q->where('is_active', true);
            }, 'region', 'typecontenu'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('front.contenus.langue', compact('contenus', 'langue'));
    }

    /**
     * Créer un nouveau contenu (pour contributeurs seulement)
     */
    public function create()
    {
        $user = Auth::user();

        // Vérifie que l'utilisateur est contributeur ou admin et actif
        if (!$user->is_active || !$user->hasRole(['contributeur', 'admin'])) {
            abort(403, 'Seuls les contributeurs peuvent créer des contenus.');
        }

        $langues = Langue::where('is_active', true)->get();
        $regions = Region::where('is_active', true)->get();
        $typecontenus = TypeContenu::where('is_active', true)->get();

        return view('front.contenus.create', compact('langues', 'regions', 'typecontenus'));
    }

    /**
     * Enregistrer un nouveau contenu
     */
    public function store(Request $request)
    {
        // Vérifier que l'utilisateur est contributeur
        $user = Auth::user();

        if (!$user->is_active || !$user->hasRole(['contributeur', 'admin'])) {
            abort(403);
        }

        // Validation
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'contenu_texte' => 'required|string',
            'langue_id' => 'required|exists:langues,id',
            'region_id' => 'nullable|exists:regions,id',
            'typecontenu_id' => 'required|exists:typecontenus,id',
            'image_couverture' => 'nullable|image|max:2048',
            'is_premium' => 'boolean',
            'prix' => 'required_if:is_premium,true|numeric|min:0',
        ]);

        // Créer le contenu
        $contenu = Contenu::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'contenu_texte' => $validated['contenu_texte'],
            'langue_id' => $validated['langue_id'],
            'region_id' => $validated['region_id'] ?? null,
            'typecontenu_id' => $validated['typecontenu_id'],
            'user_id' => $user->id,
            'status' => 'pending', // En attente de validation par modérateur
            'is_premium' => $request->has('is_premium'),
            'prix' => $request->has('is_premium') ? $validated['prix'] : null,
        ]);

        // Gérer l'image de couverture
        if ($request->hasFile('image_couverture')) {
            $path = $request->file('image_couverture')->store('contenus', 'public');
            $contenu->update(['image_couverture' => $path]);
        }

        return redirect()->route('front.contenus.show', $contenu->slug)
            ->with('success', 'Contenu créé avec succès! Il sera publié après validation par un modérateur.');
    }

    /**
     * Affiche le formulaire d'édition d'un contenu
     */
    public function edit(Contenu $contenu)
    {
        $user = Auth::user();

        // Vérifie que l'utilisateur peut modifier ce contenu
        if ($user->id !== $contenu->user_id && !$user->hasRole(['admin'])) {
            abort(403, 'Vous ne pouvez modifier que vos propres contenus.');
        }

        $langues = Langue::where('is_active', true)->get();
        $regions = Region::where('is_active', true)->get();
        $typecontenus = TypeContenu::where('is_active', true)->get();

        return view('front.contenus.edit', compact('contenu', 'langues', 'regions', 'typecontenus'));
    }

    /**
     * Mettre à jour un contenu existant
     */
    public function update(Request $request, Contenu $contenu)
    {
        $user = Auth::user();

        // Vérifie que l'utilisateur peut modifier ce contenu
        if ($user->id !== $contenu->user_id && !$user->hasRole(['admin'])) {
            abort(403);
        }

        // Validation
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'contenu_texte' => 'required|string',
            'langue_id' => 'required|exists:langues,id',
            'region_id' => 'nullable|exists:regions,id',
            'typecontenu_id' => 'required|exists:typecontenus,id',
            'image_couverture' => 'nullable|image|max:2048',
            'is_premium' => 'boolean',
            'prix' => 'required_if:is_premium,true|numeric|min:0',
        ]);

        // Mettre à jour le contenu
        $contenu->update([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'contenu_texte' => $validated['contenu_texte'],
            'langue_id' => $validated['langue_id'],
            'region_id' => $validated['region_id'] ?? null,
            'typecontenu_id' => $validated['typecontenu_id'],
            'is_premium' => $request->has('is_premium'),
            'prix' => $request->has('is_premium') ? $validated['prix'] : null,
        ]);

        // Gérer l'image de couverture
        if ($request->hasFile('image_couverture')) {
            $path = $request->file('image_couverture')->store('contenus', 'public');
            $contenu->update(['image_couverture' => $path]);
        }

        return redirect()->route('front.contenus.show', $contenu->slug)
            ->with('success', 'Contenu mis à jour avec succès! Il sera republie après validation par un modérateur.');
    }
}
