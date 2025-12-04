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
            'contenus' => Contenu::all(),
            'types' => TypeMedia::all(),
            'langues' => Langue::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenu_id' => 'required|exists:contenus,id',
            'type_media_id' => 'required|exists:typemedias,id',
            'fichier' => 'required|file|max:20000', // 20 MB
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
            'taille' => $file->getSize() / 1024, // KB
            'uploaded_by' => auth()->id(), // CORRIGÉ: upload_par -> uploaded_by
            'status' => 'pending',
        ]);

        return redirect()->route('admin.medias.index') // Changé la route
                         ->with('success', 'Média ajouté.');
    }

    public function destroy(Media $media)
    {
        // Seul l'uploader ou un admin/modérateur peut supprimer
        if ($media->uploaded_by !== auth()->id() && // CORRIGÉ
            !auth()->user()->hasRole(['admin', 'moderateur'])) {
            abort(403, 'Action non autorisée');
        }

        // Supprimer le fichier physique
        if (Storage::disk('public')->exists($media->fichier)) {
            Storage::disk('public')->delete($media->fichier);
        }

        $media->delete();

        return back()->with('success', 'Média supprimé');
    }

    public function valider(Media $media)
    {
        $media->update([
            'status' => 'validated',
            'validated_by' => auth()->id() // CORRIGÉ: valide_par -> validated_by
        ]);

        return back()->with('success', 'Média validé.');
    }

    public function rejeter(Media $media)
    {
        $media->update([
            'status' => 'rejected',
            'validated_by' => auth()->id() // CORRIGÉ
        ]);

        return back()->with('success', 'Média rejeté.');
    }
}
