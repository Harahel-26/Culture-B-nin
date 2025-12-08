<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Langue;
use App\Models\TypeContenu;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(Request $request)

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
        $query = \App\Models\Contenu::where('status', 'validated')
        ->where('is_active', true);

    $typecontenus = TypeContenu::orderBy('nom')->get();


    if ($request->filled('category')) {
        $query->where('typecontenu_id', $request->category);
    }

    $contenusFiltrés = $query->latest()->take(9)->get();


        return view('front.home.index', [
            'recents' => Contenu::valideS()->latest()->take(8)->get(),
            'premium' => Contenu::valideS()->premium()->latest()->take(8)->get(),
            'langues' => Langue::withCount('contenus')->get(),
            'gratuits' => Contenu::valideS()->gratuit()->latest()->take(8)->get(),
            'typecontenus' => $typecontenus,

        ]);
    }
}
