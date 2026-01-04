<?php

namespace App\Http\Controllers\Moderateur;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Media;
use App\Models\Commentaire;
use App\Models\ContenuTraduction;

class DashboardController extends Controller
{
    public function index()
    {
        $contenus_pending = Contenu::where('status', 'pending')->count();
        $medias_pending = Media::where('status', 'pending')->count();
        $comment_pending = Commentaire::where('statut', 'pending')->count(); // Changé de $commentaires_pending à $comment_pending
        $traductions_pending = ContenuTraduction::where('status', 'pending')->count();

        return view('moderateur.dashboard', compact(
            'contenus_pending',
            'medias_pending',
            'comment_pending', // Changé ici aussi
            'traductions_pending'
        ));
    }
}
