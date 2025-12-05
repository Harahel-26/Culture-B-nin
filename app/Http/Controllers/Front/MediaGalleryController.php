<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\TypeMedia;

class MediaGalleryController extends Controller
{
    public function index()
    {
        $images = Media::whereHas('typeMedia', fn($q) => $q->where('nom', 'image'))
                       ->validated()
                       ->latest()
                       ->get();

        $videos = Media::whereHas('typeMedia', fn($q) => $q->where('nom', 'video'))
                       ->validated()
                       ->latest()
                       ->get();

        $audios = Media::whereHas('typeMedia', fn($q) => $q->where('nom', 'audio'))
                       ->validated()
                       ->latest()
                       ->get();

        return view('front.medias.gallery', compact('images', 'videos', 'audios'));
    }
}
