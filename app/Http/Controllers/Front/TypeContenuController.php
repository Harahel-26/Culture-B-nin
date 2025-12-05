<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\TypeContenu;

class TypeContenuController extends Controller
{
    public function index()
    {
        $types = TypeContenu::orderBy('nom')->get();

        return view('front.typecontenus.index', compact('types'));
    }

    public function show($slug)
    {
        $typecontenu = TypeContenu::all()
            ->firstWhere(fn($t) => $t->slug === $slug);

        if (!$typecontenu) {
            abort(404);
        }

        $contenus = $typecontenu->contenus()
            ->with(['langue', 'region'])
            ->latest()
            ->get();

        return view('front.typecontenus.show', compact('typecontenu', 'contenus'));
    }
}
