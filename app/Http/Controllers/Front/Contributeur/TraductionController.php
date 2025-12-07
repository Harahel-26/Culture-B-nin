<?php

namespace App\Http\Controllers\Front\Contributeur;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\ContenuTraduction;
use App\Models\Langue;
use Illuminate\Http\Request;

class TraductionController extends Controller
{
    public function create(Contenu $contenu)
    {
        return view('front.contributeur.traductions.create', [
            'contenu' => $contenu,
            'langues' => Langue::all()
        ]);
    }

    public function store(Request $request, Contenu $contenu)
    {
        $request->validate([
            'langue_id' => 'required|exists:langues,id',
            'texte'     => 'required|min:20',
        ]);

        ContenuTraduction::create([
            'contenu_id' => $contenu->id,
            'langue_id'  => $request->langue_id,
            'texte'      => $request->texte,
            'traduit_par'=> auth()->id(),
            'status'     => 'pending',
        ]);

        return redirect()->route('contributeur.contenus.index')
            ->with('success', 'Traduction soumise et en attente de validation.');
    }
}
