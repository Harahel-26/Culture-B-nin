<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use Illuminate\Http\Request;

class ContenuController extends Controller
{
    public function index(Request $request)
    {
        $contenus = Contenu::with(['langue','region','typecontenu'])
            ->where('status', 'validated')
            ->where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('front.contenus.index', compact('contenus'));
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
