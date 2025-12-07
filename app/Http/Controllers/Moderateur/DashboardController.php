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
        return view('moderateur.dashboard', [
            'contenus_pending'     => Contenu::where('status','pending')->count(),
            'medias_pending'       => Media::where('status','pending')->count(),
            'comment_pending'      => Commentaire::where('statut','pending')->count(),
            'traductions_pending'  => ContenuTraduction::where('status','pending')->count(),
        ]);
    }
}
