<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Langue;
use App\Models\Region;
use App\Models\TypeContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContenuController extends Controller
{
    public function __construct()
{
    $this->middleware(['auth', 'role:contributeur|admin|moderateur']);

}


    public function index()
    {
        $contenus = Contenu::with(['langue','region','typecontenu','auteur'])
                            ->orderBy('created_at','desc')
                            ->paginate(10);

        return view('admin.contenus.index', compact('contenus'));
    }

    public function create()
    {
        return view('admin.contenus.create', [
            'langues' => Langue::all(),
            'regions' => Region::all(),
            'typecontenus' => TypeContenu::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string',
            'langue_id' => 'required|exists:langues,id',
            'region_id' => 'nullable|exists:regions,id',
            'typecontenu_id' => 'required|exists:typecontenus,id',
            'image_couverture' => 'nullable|image|max:4096',
        ]);

        $data = $request->all();

        // Upload image couverture
        if ($request->hasFile('image_couverture')) {
            $path = $request->file('image_couverture')->store('couvertures', 'public');
            $data['image_couverture'] = $path;
        }

        $data['slug'] = Str::slug($request->titre) . '-' . uniqid();
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        Contenu::create($data);

        return redirect()->route('admin.contenus.index')
            ->with('success', 'Contenu créé avec succès.');
    }

    public function show(Contenu $contenu)
    {
        return view('admin.contenus.show', compact('contenu'));
    }

    public function edit(Contenu $contenu)
    {
        return view('admin.contenus.edit', [
            'contenu' => $contenu,
            'langues' => Langue::all(),
            'regions' => Region::all(),
            'typecontenus' => TypeContenu::all(),
        ]);
    }

    public function update(Request $request, Contenu $contenu)
    {
        $request->validate([
            'titre' => 'required|string',
            'langue_id' => 'required|exists:langues,id',
            'region_id' => 'nullable|exists:regions,id',
            'typecontenu_id' => 'required|exists:typecontenus,id',
            'image_couverture' => 'nullable|image|max:4096',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_couverture')) {
            $path = $request->file('image_couverture')->store('couvertures', 'public');
            $data['image_couverture'] = $path;
        }

        $contenu->update($data);

        return redirect()->route('admin.contenus.index')
            ->with('success', 'Contenu mis à jour.');
    }

    public function destroy(Contenu $contenu)
    {
        $contenu->delete();

        return redirect()->route('admin.contenus.index')
            ->with('success', 'Contenu supprimé.');
    }

    // Validation par admin ou modérateur
    public function valider(Contenu $contenu)
    {
        $contenu->update([
            'status' => 'validated',
            'validated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Contenu validé.');
    }
    // Rejet par admin ou modérateur
    public function rejeter(Contenu $contenu)
    {
        $contenu->update([
            'status' => 'rejected',
            'validated_by' => auth()->id(),
        ]);
        return redirect()->back()->with('success', 'Contenu rejeté.');
    }
}
