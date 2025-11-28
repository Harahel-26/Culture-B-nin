<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeContenu;
use Illuminate\Http\Request;

class TypeContenuController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    public function index()
    {
        $types = TypeContenu::orderBy('nom')->paginate(10);
        return view('admin.typecontenus.index', compact('types'));
    }

    public function create()
    {
        return view('admin.typecontenus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|unique:typecontenus,nom',
        ]);

        TypeContenu::create($request->all());

        return redirect()->route('admin.typecontenus.index')
            ->with('success', 'Type de contenu créé');
    }

    public function show(TypeContenu $typecontenu)
    {
        return view('admin.typecontenus.show', compact('typecontenu'));
    }

    public function edit(TypeContenu $typecontenu)
    {
        return view('admin.typecontenus.edit', compact('typecontenu'));
    }

    public function update(Request $request, TypeContenu $typecontenu)
    {
        $request->validate([
            'nom' => "required|string|unique:typecontenus,nom,{$typecontenu->id}",
        ]);

        $typecontenu->update($request->all());

        return redirect()->route('admin.typecontenus.index')
            ->with('success', 'Modification enregistrée');
    }

    public function destroy(TypeContenu $typecontenu)
    {
        $typecontenu->delete();

        return redirect()->route('admin.typecontenus.index')
            ->with('success', 'Type supprimé');
    }
}
