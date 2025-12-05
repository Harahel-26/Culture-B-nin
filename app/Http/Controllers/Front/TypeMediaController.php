<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\TypeMedia;

class TypeMediaController extends Controller
{
    public function index()
    {
        $types = TypeMedia::orderBy('nom')->get();

        return view('front.typemedias.index', compact('types'));
    }

    public function show($slug)
    {
        $type = TypeMedia::all()->firstWhere(fn ($t) => $t->slug === $slug);

        if (!$type) abort(404);

        // Charger tous les médias de ce type
        $medias = $type->medias()
            ->with('contenu')
            ->latest()
            ->get();

        return view('front.typemedias.show', compact('type', 'medias'));
    }
}
