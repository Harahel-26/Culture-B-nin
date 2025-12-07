<?php

namespace App\Http\Controllers\Front\Contributeur;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Langue;
use App\Models\Region;
use App\Models\TypeContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContenuController extends Controller
{
    public function index()
    {
        $contenus = Contenu::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('front.contributeur.contenus.index', compact('contenus'));
    }

    public function create()
    {
        return view('front.contributeur.contenus.create', [
            'langues' => Langue::all(),
            'regions' => Region::all(),
            'typecontenus' => TypeContenu::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'langue_id' => 'required',
            'typecontenu_id' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->titre) . '-' . uniqid();
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        Contenu::create($data);

        return redirect()->route('contributeur.contenus.index')
            ->with('success', 'Contenu soumis et en attente de validation.');
    }
}
