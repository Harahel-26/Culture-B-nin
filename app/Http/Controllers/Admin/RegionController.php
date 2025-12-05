<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Langue;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $regions = Region::orderBy('nom')->paginate(10);
        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        $langues = Langue::orderBy('nom')->get();
        return view('admin.regions.create', compact('langues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:regions,nom',
            'type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'langue_principale_id' => 'nullable|exists:langues,id',
            'is_active' => 'boolean',
        ]);

        Region::create($request->only([
            'nom', 'type', 'description', 'langue_principale_id', 'is_active'
        ]));

        return redirect()->route('admin.regions.index')
            ->with('success', 'Région créée avec succès.');
    }

    public function show(Region $region)
    {
        return view('admin.regions.show', compact('region'));
    }

    public function edit(Region $region)
    {
        $langues = Langue::orderBy('nom')->get();
        return view('admin.regions.edit', compact('region', 'langues'));
    }

    public function update(Request $request, Region $region)
    {
        $request->validate([
            'nom' => "required|string|max:255|unique:regions,nom,{$region->id}",
            'type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'langue_principale_id' => 'nullable|exists:langues,id',
            'is_active' => 'boolean',
        ]);

        $region->update($request->only([
            'nom', 'type', 'description', 'langue_principale_id', 'is_active'
        ]));

        return redirect()->route('admin.regions.index')
            ->with('success', 'Région mise à jour avec succès.');
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('admin.regions.index')
            ->with('success', 'Région supprimée.');
    }
}
