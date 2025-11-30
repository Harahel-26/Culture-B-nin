<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Media;

class HomeController extends Controller
{
    public function index()
    {
        // Derniers contenus validés
        $latestContenus = Contenu::where('status', 'validated')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Dernières vidéos
        $latestVideos = Media::where('type_media_id', 2) // id vidéo dans typemedias
            ->where('status', 'validated')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Dernières images
        $gallery = Media::where('type_media_id', 1) // id image
            ->where('status', 'validated')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Derniers audios
        $latestAudios = Media::where('type_media_id', 3) // id audio
            ->where('status', 'validated')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('front.home.index', compact(
            'latestContenus',
            'latestVideos',
            'gallery',
            'latestAudios'
        ));
    }
}
