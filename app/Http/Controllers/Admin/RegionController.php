<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    public function index()
    {
        $regions = Region::paginate(10);
        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        return view('admin.regions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'type' => 'nullable|string',
            'description' => 'nullable|string',
            'langue_principale' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Region::create($request->all());

        return redirect()->route('admin.regions.index')
            ->with('success', 'Région créée avec succès');
    }

    public function show(Region $region)
    {
        return view('admin.regions.show', compact('region'));
    }

    public function edit(Region $region)
    {
        return view('admin.regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $request->validate([
            'nom' => 'required|string',
            'type' => 'nullable|string',
            'description' => 'nullable|string',
            'langue_principale' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $region->update($request->all());

        return redirect()->route('admin.regions.index')
            ->with('success', 'Région mise à jour avec succès');
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('admin.regions.index')
            ->with('success', 'Région supprimée');
    }
}
