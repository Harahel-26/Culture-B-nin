<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contenu;

class FavoriController extends Controller
{
    public function toggle(Request $request)
    {
        $data = $request->validate([
            'contenu_id' => 'required|exists:contenus,id',
        ]);

        $user = auth()->user();
        $contenuId = $data['contenu_id'];

        // On regarde si déjà en favoris
        if ($user->favoris()->where('contenu_id', $contenuId)->exists()) {
            $user->favoris()->detach($contenuId);
            $message = 'Retiré de vos favoris.';
        } else {
            $user->favoris()->attach($contenuId);
            $message = 'Ajouté à vos favoris.';
        }

        return back()->with('success', $message);
    }
}
