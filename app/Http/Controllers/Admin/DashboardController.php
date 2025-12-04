<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Media;
use App\Models\ContenuTraduction;
use App\Models\Commentaire;
use App\Models\User;
use App\Models\Langue;
use Illuminate\Support\Facades\DB;
use App\Models\Paiement;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin|moderateur']);
    }
    public function index()
    {
        // STATISTIQUES GLOBALES
        $stats = [
            'contenus_total'       => Contenu::count(),
            'contenus_valides'     => Contenu::where('status', 'validated')->count(),
            'contenus_attente'     => Contenu::where('status', 'pending')->count(),
            'medias_total'         => Media::count(),
            'traductions_total'    => ContenuTraduction::count(),
            'commentaires_total'   => Commentaire::count(),
            'users_total'          => User::count(),
            'notes_moyenne'        => Commentaire::avg('note'),
        ];

        // UTILISATEURS PAR RÔLE (avec Spatie)
$users_roles = DB::table('model_has_roles')
    ->select('role_id', DB::raw('COUNT(*) as total'))
    ->groupBy('role_id')
    ->get()
    ->map(function($item) {
        $role = \Spatie\Permission\Models\Role::find($item->role_id);
        return [
            'role_name' => $role ? $role->name : 'Unknown',
            'total' => $item->total
        ];
    });

        // CONTENUS PAR MOIS (12 mois)
        $contenus_mois = Contenu::select(
            DB::raw('MONTH(created_at) AS mois'),
            DB::raw('COUNT(*) AS total')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('mois')
        ->pluck('total', 'mois')
        ->toArray();

        // LANGUES LES PLUS UTILISÉES
        $langues_plus = Contenu::select('langue_id', DB::raw('COUNT(*) as total'))
            ->groupBy('langue_id')
            ->with('langue')
            ->orderBy('total', 'DESC')
            ->take(5)
            ->get();

        // TYPES DE CONTENU LES PLUS CRÉÉS
        $types_plus = Contenu::select('typecontenu_id', DB::raw('COUNT(*) as total'))
            ->groupBy('typecontenu_id')
            ->with('typecontenu')
            ->orderBy('total', 'DESC')
            ->take(5)
            ->get();

        // Statistiques sur les paiements
        $paiements = [
            'total' => Paiement::where('statut', 'paye')->count(),
            'montant_total' => Paiement::where('statut', 'paye')->sum('montant'),
            'recent' => Paiement::where('statut', 'paye')->orderBy('created_at', 'desc')->take(5)->get(),
        ];

        // Contenus premium
        $stats['contenus_premium'] = Contenu::where('is_premium', true)->count();

        // Commentaires en attente
        $stats['commentaires_attente'] = Commentaire::where('statut', 'pending')->count();

        // Utilisateurs contributeurs/admins
        $stats['users_contributeurs'] = User::role('contributeur')->count();
        $stats['users_admins'] = User::role('admin')->count();

        // Contenus récents
        $contenusRecents = Contenu::with(['utilisateur', 'langue'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Commentaires récents
        $commentairesRecents = Commentaire::with(['utilisateur', 'contenu'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboards.index', compact(
            'stats',
            'users_roles',
            'contenus_mois',
            'langues_plus',
            'types_plus',
            'paiements',
            'contenusRecents',
            'commentairesRecents'
        ));
    }
}
