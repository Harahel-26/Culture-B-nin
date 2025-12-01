<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\TypeContenu;
use App\Models\Langue;
use App\Models\Region;
use App\Models\Contenu;

class ExploreController extends Controller
{
    public function categories()
    {
        $categories = TypeContenu::orderBy('nom')->get();
        return view('front.explore.categories', compact('categories'));
    }

    public function categorieShow($slug)
    {
        $categorie = TypeContenu::where('slug', $slug)->firstOrFail();

        $contenus = Contenu::where('type_contenu_id', $categorie->id)
                            ->latest()
                            ->paginate(12);

        return view('front.explore.categorie-show', compact('categorie', 'contenus'));
    }

    public function regions()
    {
        $regions = Region::orderBy('nom')->get();
        return view('front.explore.regions', compact('regions'));
    }

    public function regionShow($slug)
    {
        $region = Region::where('slug', $slug)->firstOrFail();

        $contenus = Contenu::where('region_id', $region->id)
                            ->latest()
                            ->paginate(12);

        return view('front.explore.region-show', compact('region', 'contenus'));
    }

    public function langues()
    {
        $langues = Langue::orderBy('nom')->get();
        return view('front.explore.langues', compact('langues'));
    }

    public function langueShow($code)
    {
        $langue = Langue::where('code', $code)->firstOrFail();

        $contenus = Contenu::where('langue_id', $langue->id)
                            ->latest()
                            ->paginate(12);

        return view('front.explore.langue-show', compact('langue', 'contenus'));
    }
}
