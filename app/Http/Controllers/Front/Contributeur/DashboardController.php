<?php

namespace App\Http\Controllers\Front\Contributeur;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Statistiques
        $total_contenus = Contenu::where('user_id', $user->id)->count();
        $en_attente = Contenu::where('user_id', $user->id)
                            ->where('status', 'pending')
                            ->count();
        $valides = Contenu::where('user_id', $user->id)
                         ->where('status', 'validated')
                         ->count();
        $rejetes = Contenu::where('user_id', $user->id)
                         ->where('status', 'rejected')
                         ->count();

        // Activité récente (derniers contenus modifiés)
        $recent_activities = Contenu::where('user_id', $user->id)
                                   ->with(['typecontenu'])
                                   ->orderBy('updated_at', 'desc')
                                   ->take(4)
                                   ->get()
                                   ->map(function($contenu) {
                                       return [
                                           'type' => $this->getActivityType($contenu),
                                           'title' => $contenu->titre,
                                           'time' => $contenu->updated_at->diffForHumans(),
                                           'status' => $contenu->status,
                                           'contenu' => $contenu
                                       ];
                                   });

        return view('front.contributeur.dashboard', compact(
            'total_contenus',
            'en_attente',
            'valides',
            'rejetes',
            'recent_activities'
        ));
    }

    private function getActivityType($contenu)
    {
        // Si le contenu a été créé récemment
        if ($contenu->created_at->diffInHours(now()) < 24) {
            return 'created';
        }

        // Si le contenu a été mis à jour récemment
        if ($contenu->updated_at->gt($contenu->created_at)) {
            return 'updated';
        }

        // Selon le statut
        switch ($contenu->status) {
            case 'validated': return 'validated';
            case 'rejected': return 'rejected';
            default: return 'updated';
        }
    }
}
