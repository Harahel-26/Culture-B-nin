<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use Illuminate\Http\Request;

class ContenuController extends Controller
{
    // PAGE LISTE DES CONTENUS
    public function index(Request $request)
    {
        $query = Contenu::where('status', 'validated')
                        ->with(['langue', 'region', 'auteur'])
                        ->orderBy('created_at', 'desc');

        // Si on veut filtrer par type, langue, région (optionnel)
        if ($request->filled('type')) {
            $query->where('typecontenu_id', $request->type);
        }

        if ($request->filled('langue')) {
            $query->where('langue_id', $request->langue);
        }

        if ($request->filled('region')) {
            $query->where('region_id', $request->region);
        }

        $contenus = $query->paginate(9);

        return view('front.contenus.index', compact('contenus'));
    }

    // PAGE DETAIL D'UN CONTENU
    // Dans app/Http/Controllers/Front/ContenuController.php
public function show($slug)
{
    $contenu = Contenu::where('slug', $slug)
        ->where('status', 'validated')
        ->with([
            'auteur',
            'langue',
            'region',
            'typecontenu',
            'medias' => function($q) {
                $q->where('status', 'validated');
            },
            'commentaires' => function($q) {
                $q->where('statut', 'validated')
                  ->whereNull('parent_id')
                  ->with(['auteur', 'reponses' => function($q) {
                      $q->where('statut', 'validated')->with('auteur');
                  }]);
            }
        ])
        ->firstOrFail();

    // Calcul moyenne des notes
    $moyenneNotes = $contenu->commentaires->avg('note');
    $totalNotes = $contenu->commentaires->count();

    // Suggestions
    $suggestions = Contenu::where('typecontenu_id', $contenu->typecontenu_id)
        ->where('id', '!=', $contenu->id)
        ->where('status', 'validated')
        ->with(['langue', 'region'])
        ->take(4)
        ->get();

    return view('front.contenus.show', compact(
        'contenu',
        'suggestions',
        'moyenneNotes',
        'totalNotes'
    ));
}
}
