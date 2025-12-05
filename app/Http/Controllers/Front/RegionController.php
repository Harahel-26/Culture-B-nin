<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Region;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::where('is_active', true)
            ->orderBy('nom')
            ->get();

        return view('front.regions.index', compact('regions'));
    }

    public function show($slug)
    {
        $region = Region::whereRaw("LOWER(REPLACE(nom, ' ', '-')) = ?", [$slug])
            ->where('is_active', true)
            ->firstOrFail();

        $contenus = $region->contenus()
            ->latest()
            ->take(12)
            ->get();

        return view('front.regions.show', compact('region', 'contenus'));
    }
}
