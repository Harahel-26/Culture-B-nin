<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use Illuminate\Http\Request;

class ContenuController extends Controller
{
    public function index(Request $request)
{
    $query = Contenu::where('status', 'validated')
                    ->where('is_active', true)
                    ->with(['langue','region','typecontenu']);

    if ($request->filled('langue')) {
        $query->where('langue_id', $request->langue);
    }

    if ($request->filled('region')) {
        $query->where('region_id', $request->region);
    }

    if ($request->filled('type')) {
        $query->where('typecontenu_id', $request->type);
    }

    $contenus = $query->orderBy('published_at','desc')->paginate(9);

    return view('front.contenus.index', [
        'contenus' => $contenus,
        'langues' => \App\Models\Langue::all(),
        'regions' => \App\Models\Region::all(),
        'typecontenus' => \App\Models\TypeContenu::all(),
    ]);
}


    public function show($slug)
    {
        $contenu = Contenu::with(['langue','region','typecontenu','medias','commentaires'])
            ->where('slug', $slug)
            ->where('status', 'validated')
            ->firstOrFail();

        // On incrémente les vues
        $contenu->incrementerVues();

        $user = auth()->user();
        $accessible = $contenu->est_accessible;

        return view('front.contenus.show', compact('contenu','accessible','user'));
    }
}
