<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Langue;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


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
            'code' => 'required|string|unique:langues,code',
            'nom' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        Langue::create($request->all());

        return redirect()->route('admin.langues.index')
            ->with('success', 'Langue créée avec succès');
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
            'code' => "required|string|unique:langues,code,{$langue->id}",
            'nom' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $langue->update($request->all());

        return redirect()->route('admin.langues.index')
            ->with('success', 'Langue mise à jour avec succès');
    }

    public function destroy(Langue $langue)
    {
        $langue->delete();
        return redirect()->route('admin.langues.index')
            ->with('success', 'Langue supprimée');
    }
}
