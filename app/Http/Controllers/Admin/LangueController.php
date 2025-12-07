<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Langue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LangueController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $langues = Langue::orderBy('nom')->paginate(10);
        return view('admin.langues.index', compact('langues'));
    }

    public function create()
    {
        return view('admin.langues.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:langues,code',
            'nom' => 'required|string|max:255|unique:langues,nom',
            'description' => 'nullable|string',
            'icone' => 'nullable|image|mimes:png,svg,jpg,jpeg|max:2048'
        ]);

        $data = $request->only(['code', 'nom', 'description']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('icone')) {
            $data['icone'] = $request->file('icone')->store('langues', 'public');
        }

        Langue::create($data);

        return redirect()->route('admin.langues.index')
            ->with('success', 'Langue créée avec succès.');
    }

    public function show(Langue $langue)
    {
        return view('admin.langues.show', compact('langue'));
    }

    public function edit(Langue $langue)
    {
        return view('admin.langues.edit', compact('langue'));
    }

    public function update(Request $request, Langue $langue)
    {
        $request->validate([
            'code' => "required|string|max:10|unique:langues,code,{$langue->id}",
            'nom' => "required|string|max:255|unique:langues,nom,{$langue->id}",
            'description' => 'nullable|string',
            'icone' => 'nullable|image|mimes:png,svg,jpg,jpeg|max:2048'
        ]);

        $data = $request->only(['code', 'nom', 'description']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('icone')) {
            // supprime ancienne icône
            if ($langue->icone && Storage::disk('public')->exists($langue->icone)) {
                Storage::disk('public')->delete($langue->icone);
            }

            $data['icone'] = $request->file('icone')->store('langues', 'public');
        }

        $langue->update($data);

        return redirect()->route('admin.langues.index')
            ->with('success', 'Langue mise à jour avec succès.');
    }

    public function destroy(Langue $langue)
    {
        if ($langue->icone && Storage::disk('public')->exists($langue->icone)) {
            Storage::disk('public')->delete($langue->icone);
        }

        $langue->delete();

        return redirect()->route('admin.langues.index')
            ->with('success', 'Langue supprimée avec succès.');
    }
}
