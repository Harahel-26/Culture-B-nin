<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Media;
use App\Models\TypeContenu;
use App\Models\Langue;
use App\Models\Region;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $type = $request->input('type');
        $langue = $request->input('langue');
        $region = $request->input('region');
        $categorie = $request->input('categorie');

        // 🔍 contenus
        $contenus = Contenu::query()
            ->where('titre', 'LIKE', "%{$query}%")
            ->orWhere('resume', 'LIKE', "%{$query}%")
            ->orWhere('contenu', 'LIKE', "%{$query}%");

        // filtres
        if ($categorie) $contenus->where('type_contenu_id', $categorie);
        if ($langue) $contenus->where('langue_id', $langue);
        if ($region) $contenus->where('region_id', $region);

        $contenus = $contenus->paginate(10);

        // 🔍 médias (si type = vide ou media)
        $medias = Media::query()
            ->where('titre', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(12);

        return view('front.search.index', [
            'query' => $query,
            'contenus' => $contenus,
            'medias' => $medias,
            'types' => TypeContenu::all(),
            'langues' => Langue::all(),
            'regions' => Region::all()
        ]);
    }
}
