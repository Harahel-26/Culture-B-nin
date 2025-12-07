<?php

namespace App\Http\Controllers\Front\Contributeur;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Media;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('front.contributeur.dashboard', [
            'total_contenus'    => Contenu::where('user_id', $user->id)->count(),
            'en_attente'        => Contenu::where('user_id', $user->id)->where('status', 'pending')->count(),
            'valides'           => Contenu::where('user_id', $user->id)->where('status', 'validated')->count(),
            'rejetes'           => Contenu::where('user_id', $user->id)->where('status', 'rejected')->count(),
            'total_medias'      => Media::where('uploaded_by', $user->id)->count(),
        ]);
    }
}
