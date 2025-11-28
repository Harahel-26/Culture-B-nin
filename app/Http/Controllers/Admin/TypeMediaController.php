<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeMedia;
use Illuminate\Http\Request;

class TypeMediaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $medias = TypeMedia::orderBy('nom')->paginate(10);
        return view('admin.typemedias.index', compact('medias'));
    }

    public function create()
    {
        return view('admin.typemedias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|unique:typemedias,nom',
        ]);

        TypeMedia::create($request->all());

        return redirect()->route('admin.typemedias.index')
            ->with('success', 'Type de média créé avec succès');
    }

    public function show(TypeMedia $typemedia)
    {
        return view('admin.typemedias.show', compact('typemedia'));
    }

    public function edit(TypeMedia $typemedia)
    {
        return view('admin.typemedias.edit', compact('typemedia'));
    }

    public function update(Request $request, TypeMedia $typemedia)
    {
        $request->validate([
            'nom' => "required|string|unique:typemedias,nom,{$typemedia->id}",
        ]);

        $typemedia->update($request->all());

        return redirect()->route('admin.typemedias.index')
            ->with('success', 'Type de média modifié');
    }

    public function destroy(TypeMedia $typemedia)
    {
        $typemedia->delete();

        return redirect()->route('admin.typemedias.index')
            ->with('success', 'Type de média supprimé');
    }
}
