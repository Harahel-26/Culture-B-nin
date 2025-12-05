<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Langue;
use App\Models\Region;
use App\Models\TypeContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContenuController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:contributeur|admin|moderateur']);
    }

    public function index(Request $request)
    {
        $query = Contenu::with(['langue','region','typecontenu','utilisateur'])
                        ->orderBy('created_at','desc');

        // Filtre statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $contenus = $query->paginate(15);

        return view('admin.contenus.index', compact('contenus'));
    }

    public function create()
    {
        return view('admin.contenus.create', [
            'langues'      => Langue::orderBy('nom')->get(),
            'regions'      => Region::orderBy('nom')->get(),
            'typecontenus' => TypeContenu::orderBy('nom')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'            => 'required|string|max:255',
            'langue_id'        => 'required|exists:langues,id',
            'region_id'        => 'nullable|exists:regions,id',
            'typecontenu_id'   => 'required|exists:typecontenus,id',
            'image_couverture' => 'nullable|image|max:4096',
            'contenu_texte'    => 'nullable|string',
            'is_premium'       => 'boolean',
            'prix'             => 'nullable|numeric|min:100',
        ]);

        $data = $request->all();

        // Si premium, prix obligatoire
        if ($request->is_premium && !$request->prix) {
            return back()->withErrors(['prix' => 'Le prix est obligatoire pour un contenu premium.'])
                         ->withInput();
        }

        // Upload image de couverture
        if ($request->hasFile('image_couverture')) {
            $data['image_couverture'] = $request->file('image_couverture')
                                               ->store('contenus/couvertures', 'public');
        }

        $data['slug'] = Str::slug($request->titre) . '-' . uniqid();
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        $contenu = Contenu::create($data);

        return redirect()->route('admin.contenus.index')
                         ->with('success', 'Contenu créé et soumis pour validation.');
    }

    public function show(Contenu $contenu)
    {
        $contenu->load(['langue','region','typecontenu','utilisateur','medias']);
        return view('admin.contenus.show', compact('contenu'));
    }

    public function edit(Contenu $contenu)
    {
        return view('admin.contenus.edit', [
            'contenu'      => $contenu,
            'langues'      => Langue::orderBy('nom')->get(),
            'regions'      => Region::orderBy('nom')->get(),
            'typecontenus' => TypeContenu::orderBy('nom')->get(),
        ]);
    }

    public function update(Request $request, Contenu $contenu)
    {
        $request->validate([
            'titre'            => 'required|string|max:255',
            'langue_id'        => 'required|exists:langues,id',
            'region_id'        => 'nullable|exists:regions,id',
            'typecontenu_id'   => 'required|exists:typecontenus,id',
            'image_couverture' => 'nullable|image|max:4096',
            'contenu_texte'    => 'nullable|string',
            'is_premium'       => 'boolean',
            'prix'             => 'nullable|numeric|min:100',
        ]);

        $data = $request->all();

        // Premium : prix obligatoire
        if ($request->is_premium && !$request->prix) {
            return back()->withErrors(['prix' => 'Le prix est obligatoire pour un contenu premium.']);
        }

        // Changer image couverture
        if ($request->hasFile('image_couverture')) {

            if ($contenu->image_couverture && Storage::disk('public')->exists($contenu->image_couverture)) {
                Storage::disk('public')->delete($contenu->image_couverture);
            }

            $data['image_couverture'] = $request->file('image_couverture')
                                               ->store('contenus/couvertures', 'public');
        }

        $contenu->update($data);

        return redirect()->route('admin.contenus.index')
                         ->with('success', 'Contenu mis à jour.');
    }

    public function destroy(Contenu $contenu)
    {
        // supprimer image couverture
        if ($contenu->image_couverture && Storage::disk('public')->exists($contenu->image_couverture)) {
            Storage::disk('public')->delete($contenu->image_couverture);
        }

        $contenu->delete();

        return redirect()->route('admin.contenus.index')->with('success', 'Contenu supprimé.');
    }

    public function valider(Contenu $contenu)
    {
        $contenu->update([
            'status' => 'validated',
            'validated_by' => auth()->id(),
            'published_at' => now(),
        ]);

        return back()->with('success', 'Contenu validé et publié.');
    }

    public function rejeter(Contenu $contenu)
    {
        $contenu->update([
            'status' => 'rejected',
            'validated_by' => auth()->id(),
        ]);

        return back()->with('success', 'Contenu rejeté.');
    }
}
