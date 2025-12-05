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
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin|moderateur']);
    }

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
            'contenus' => Contenu::orderBy('titre')->get(),
            'types' => TypeMedia::orderBy('nom')->get(),
            'langues' => Langue::orderBy('nom')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenu_id' => 'required|exists:contenus,id',
            'type_media_id' => 'required|exists:typemedias,id',
            'fichier' => 'required|file|max:20000',
            'titre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'langue_id' => 'nullable|exists:langues,id',
        ]);

        $file = $request->file('fichier');
        $path = $file->store('medias', 'public');

        Media::create([
            'contenu_id' => $request->contenu_id,
            'type_media_id' => $request->type_media_id,
            'langue_id' => $request->langue_id,
            'titre' => $request->titre,
            'description' => $request->description,
            'fichier' => $path,
            'extension' => $file->extension(),
            'taille' => intval($file->getSize() / 1024),
            'uploaded_by' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()
            ->route('admin.medias.index')
            ->with('success', 'Média ajouté avec succès.');
    }

    public function destroy(Media $media)
    {
        if ($media->uploaded_by !== auth()->id() &&
            !auth()->user()->hasRole(['admin', 'moderateur'])) {
            abort(403, 'Action non autorisée');
        }

        if (Storage::disk('public')->exists($media->fichier)) {
            Storage::disk('public')->delete($media->fichier);
        }

        $media->delete();

        return back()->with('success', 'Média supprimé avec succès.');
    }

    public function valider(Media $media)
    {
        $media->update([
            'status' => 'validated',
            'validated_by' => auth()->id()
        ]);

        return back()->with('success', 'Média validé.');
    }
    public function update(Request $request, Media $media)
{
    $request->validate([
        'contenu_id' => 'required|exists:contenus,id',
        'type_media_id' => 'required|exists:typemedias,id',
        'titre' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'langue_id' => 'nullable|exists:langues,id',
    ]);

    $media->update([
        'contenu_id' => $request->contenu_id,
        'type_media_id' => $request->type_media_id,
        'titre' => $request->titre,
        'description' => $request->description,
        'langue_id' => $request->langue_id,
    ]);

    return redirect()
        ->route('admin.medias.index')
        ->with('success', 'Média mis à jour avec succès.');
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
