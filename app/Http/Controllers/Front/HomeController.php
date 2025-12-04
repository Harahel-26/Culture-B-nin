<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Langue;
use App\Models\Region;
use App\Models\TypeContenu;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Derniers contenus validés
        $derniersContenus = Contenu::where('status', 'validated')
            ->where('is_active', true)
            ->with(['utilisateur' => function($q) {
                $q->where('is_active', true);
            }, 'langue', 'region', 'typecontenu'])
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Contenus populaires (par nombre de vues)
        $contenusPopulaires = Contenu::where('status', 'validated')
            ->where('is_active', true)
            ->orderBy('vues_total', 'desc')
            ->with(['utilisateur' => function($q) {
                $q->where('is_active', true);
            }])
            ->take(6)
            ->get();

        // Mieux notés (par moyenne des notes)
        $mieuxNotes = Contenu::where('status', 'validated')
            ->where('is_active', true)
            ->with(['utilisateur' => function($q) {
                $q->where('is_active', true);
            }])
            ->withCount(['commentaires as moyenne_notes' => function($query) {
                $query->select(DB::raw('COALESCE(AVG(note), 0)'));
            }])
            ->orderBy('moyenne_notes', 'desc')
            ->take(6)
            ->get();

        // Filtres pour la recherche
        $langues = Langue::where('is_active', true)->get();
        $regions = Region::where('is_active', true)->get();
        $typecontenus = TypeContenu::where('is_active', true)->get();

        // Suggestions pour la recherche
        $suggestions = [
            'Contes traditionnels',
            'Musique béninoise',
            'Danses folkloriques',
            'Artisanat local',
            'Cuisine traditionnelle',
            'Patrimoine historique',
            'Proverbes',
            'Cérémonies',
            'Costumes',
            'Instruments de musique'
        ];

        // Statistiques pour le footer
        $stats = [
            'total_contenus' => Contenu::where('status', 'validated')->where('is_active', true)->count(),
            'total_langues' => $langues->count(),
            'total_regions' => $regions->count(),
        ];

        return view('front.accueil', compact(
            'derniersContenus',
            'contenusPopulaires',
            'mieuxNotes',
            'langues',
            'regions',
            'typecontenus',
            'suggestions',
            'stats'
        ));
    }
}
