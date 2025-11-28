<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Contenu;
use App\Models\TypeMedia;
use App\Models\Langue;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $medias = Media::with(['contenu', 'typeMedia', 'uploader'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);

        return view('admin.medias.index', compact('medias'));
    }

    public function create()
    {
        return view('admin.medias.create', [
            'contenus' => Contenu::all(),
            'types' => TypeMedia::all(),
            'langues' => Langue::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenu_id' => 'required',
            'type_media_id' => 'required',
            'fichier' => 'required|file|max:20000', // 20 MB
        ]);

        $file = $request->file('fichier');
        $path = $file->store('medias', 'public');

        $media = Media::create([
            'contenu_id' => $request->contenu_id,
            'type_media_id' => $request->type_media_id,
            'langue_id' => $request->langue_id,
            'titre' => $request->titre,
            'description' => $request->description,
            'fichier' => $path,
            'extension' => $file->extension(),
            'taille' => $file->getSize() / 1024,
            'upload_par' => auth()->id(),
        ]);

        return redirect()->route('medias.index')
                         ->with('success', 'Média ajouté.');
    }

    public function destroy(Media $media)
    {
        Storage::disk('public')->delete($media->fichier);
        $media->delete();

        return back()->with('success', 'Média supprimé');
    }

    public function valider(Media $media)
    {
        $media->update([
            'status' => 'validated',
            'valide_par' => auth()->id()
        ]);

        return back()->with('success', 'Média validé.');
    }

    public function rejeter(Media $media)
    {
        $media->update([
            'status' => 'rejected',
            'valide_par' => auth()->id()
        ]);

        return back()->with('success', 'Média rejeté.');
    }
}
