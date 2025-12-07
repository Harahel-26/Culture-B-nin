<?php

namespace App\Http\Controllers\Moderateur;

use App\Http\Controllers\Controller;
use App\Models\Media;

class MediaModerationController extends Controller
{
    public function index()
    {
        $medias = Media::where('status', 'pending')
            ->with(['typeMedia', 'uploader', 'contenu'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('moderateur.medias.index', compact('medias'));
    }

    public function valider(Media $media)
    {
        $media->update([
            'status' => 'validated',
            'validated_by' => auth()->id()
        ]);

        return back()->with('success', 'Média validé avec succès.');
    }

    public function rejeter(Media $media)
    {
        $media->update([
            'status' => 'rejected',
            'validated_by' => auth()->id()
        ]);

        return back()->with('success', 'Média rejeté.');
    }
}
