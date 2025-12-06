<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use Illuminate\Http\Request;

class FavoriController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'contenu_id' => 'required|exists:contenus,id',
        ]);

        $user = auth()->user();
        $contenuId = $request->contenu_id;

        if ($user->favoris()->where('contenu_id', $contenuId)->exists()) {
            // Retirer des favoris
            $user->favoris()->detach($contenuId);
            return response()->json(['status' => 'removed']);
        } else {
            // Ajouter aux favoris
            $user->favoris()->attach($contenuId);
            return response()->json(['status' => 'added']);
        }
    }

    public function index()
    {
        $favoris = auth()->user()
                        ->favoris()
                        ->with('typecontenu','langue')
                        ->orderBy('published_at','desc')
                        ->get();

        return view('front.favoris.index', compact('favoris'));
    }
}
