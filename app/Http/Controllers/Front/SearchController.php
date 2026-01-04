<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Media;
use App\Models\TypeContenu;
use App\Models\Langue;
use App\Models\Region;
use App\Models\TypeMedia;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Page principale de recherche
     */
    public function index(Request $request)
    {
        $query = trim($request->input('q', ''));
        $categorie = $request->input('categorie');
        $langue = $request->input('langue');
        $region = $request->input('region');
        $type = $request->input('type'); // type de média

        // Recherche dans les contenus
        $contenusQuery = Contenu::query()
            ->where('status', 'validated')
            ->where('is_active', true)
            ->with(['utilisateur', 'langue', 'region', 'typecontenu']);

        if (!empty($query)) {
            $contenusQuery->where(function($q) use ($query) {
                $q->where('titre', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('contenu_texte', 'LIKE', "%{$query}%");
            });
        }
        if ($categorie) {
            $contenusQuery->where('typecontenu_id', $categorie);
        }
        if ($langue) {
            $contenusQuery->where('langue_id', $langue);
        }
        if ($region) {
            $contenusQuery->where('region_id', $region);
        }

        $contenus = $contenusQuery->orderBy('created_at', 'desc')->paginate(12);

        // Recherche dans les médias (si query ou filtre type)
        $medias = collect();
        if (!empty($query) || $type) {
            $mediasQuery = Media::query()
                ->where('status', 'validated') // Utilisez 'status' au lieu de 'is_active'
                ->with(['contenu', 'typeMedia']);

            if (!empty($query)) {
                $mediasQuery->where(function($q) use ($query) {
                    $q->where('titre', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%");
                });
            }
            if ($type) {
                $mediasQuery->where('type_media_id', $type);
            }

            $medias = $mediasQuery->orderBy('created_at', 'desc')->paginate(12);
        }

        // Données pour les filtres
        $typesContenu = TypeContenu::all(); // Retirez le where('is_active', true)
        $langues = Langue::all(); // Retirez le where('is_active', true)
        $regions = Region::all(); // Retirez le where('is_active', true)
        $typesMedia = TypeMedia::all();

        $totalResults = $contenus->total() + $medias->total();

        return view('front.search.index', [
            'query' => $query,
            'contenus' => $contenus,
            'medias' => $medias,
            'types' => $typesContenu,
            'langues' => $langues,
            'regions' => $regions,
            'typesMedia' => $typesMedia,
            'totalResults' => $totalResults,
            'filters' => [
                'categorie' => $categorie,
                'langue' => $langue,
                'region' => $region,
                'type' => $type
            ]
        ]);
    }

    /**
     * Recherche avancée
     */
    public function advanced(Request $request)
    {
        $query = trim($request->input('q', ''));
        $filters = $request->only(['categorie', 'langue', 'region', 'type_media', 'is_premium', 'date_start', 'date_end']);

        $contenusQuery = Contenu::query()
            ->where('status', 'validated')
            ->where('is_active', true)
            ->with(['utilisateur', 'langue', 'region', 'typecontenu', 'medias']);

        if (!empty($query)) {
            $contenusQuery->where(function($q) use ($query) {
                $q->where('titre', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('contenu_texte', 'LIKE', "%{$query}%");
            });
        }
        if (!empty($filters['categorie'])) {
            $contenusQuery->where('typecontenu_id', $filters['categorie']);
        }
        if (!empty($filters['langue'])) {
            $contenusQuery->where('langue_id', $filters['langue']);
        }
        if (!empty($filters['region'])) {
            $contenusQuery->where('region_id', $filters['region']);
        }
        if (isset($filters['is_premium'])) {
            $contenusQuery->where('is_premium', $filters['is_premium'] == 'true');
        }
        if (!empty($filters['type_media'])) {
            $contenusQuery->whereHas('medias', function($q) use ($filters) {
                $q->where('type_media_id', $filters['type_media'])
                  ->where('status', 'validated');
            });
        }
        if (!empty($filters['date_start'])) {
            $contenusQuery->whereDate('created_at', '>=', $filters['date_start']);
        }
        if (!empty($filters['date_end'])) {
            $contenusQuery->whereDate('created_at', '<=', $filters['date_end']);
        }

        $results = $contenusQuery->orderBy('created_at', 'desc')->paginate(20);

        $types = TypeContenu::all();
        $langues = Langue::all();
        $regions = Region::all();
        $typeMedias = TypeMedia::all();

        return view('front.search.advanced', compact('results', 'query', 'filters', 'types', 'langues', 'regions', 'typeMedias'));
    }

    /**
     * Recherche en temps réel (AJAX)
     */
    public function autocomplete(Request $request)
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $results = [];

        // Suggestions de titres de contenus
        $titres = Contenu::where('status', 'validated')
            ->where('is_active', true)
            ->where('titre', 'LIKE', "{$query}%")
            ->select('titre', 'slug')
            ->distinct()
            ->take(5)
            ->get()
            ->map(function($item) {
                return [
                    'type' => 'contenu',
                    'text' => $item->titre,
                    'url' => route('front.contenus.show', $item->slug)
                ];
            });

        $results = array_merge($results, $titres->toArray());

        // Suggestions de langues
        $langues = Langue::where(function($q) use ($query) {
                $q->where('nom', 'LIKE', "{$query}%")
                  ->orWhere('code', 'LIKE', "{$query}%");
            })
            ->select('nom', 'code')
            ->take(3)
            ->get()
            ->map(function($item) {
                return [
                    'type' => 'langue',
                    'text' => $item->nom,
                    'url' => route('front.contenus.langue', $item->code)
                ];
            });

        $results = array_merge($results, $langues->toArray());

        // Suggestions de régions
        $regions = Region::where('nom', 'LIKE', "{$query}%")
            ->select('nom', 'slug')
            ->take(3)
            ->get()
            ->map(function($item) {
                return [
                    'type' => 'region',
                    'text' => $item->nom,
                    'url' => route('front.contenus.region', $item->slug)
                ];
            });

        $results = array_merge($results, $regions->toArray());

        return response()->json($results);
    }
}
