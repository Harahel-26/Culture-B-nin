<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;

class HomeController extends Controller
{
    public function index()
    {
        $recents = Contenu::where('status','validated')
                          ->where('is_active', true)
                          ->orderBy('published_at','desc')
                          ->take(6)
                          ->get();

        $premium = Contenu::where('status','validated')
                          ->where('is_active', true)
                          ->where('is_premium', true)
                          ->orderBy('vues_total','desc')
                          ->take(6)
                          ->get();

        $gratuits = Contenu::where('status','validated')
                           ->where('is_active', true)
                           ->where('is_premium', false)
                           ->take(6)
                           ->get();

        return view('front.home.index', compact('recents','premium','gratuits'));
    }
}
