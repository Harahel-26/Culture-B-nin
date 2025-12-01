<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        $images = Media::where('type_media_id', 1)
            ->where('status', 'validated')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $videos = Media::where('type_media_id', 2)
            ->where('status', 'validated')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        $audios = Media::where('type_media_id', 3)
            ->where('status', 'validated')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('front.medias.index', compact('images', 'videos', 'audios'));
    }

    public function images()
    {
        $images = Media::where('type_media_id', 1)
            ->where('status', 'validated')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('front.medias.images', compact('images'));
    }

    public function videos()
    {
        $videos = Media::where('type_media_id', 2)
            ->where('status', 'validated')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('front.medias.videos', compact('videos'));
    }

    public function audios()
    {
        $audios = Media::where('type_media_id', 3)
            ->where('status', 'validated')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('front.medias.audios', compact('audios'));
    }
}
