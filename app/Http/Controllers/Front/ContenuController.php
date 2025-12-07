<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use Illuminate\Http\Request;
use App\Models\Langue;
use App\Models\Region;
use App\Models\TypeContenu;

class ContenuController extends Controller
{
    public function index(Request $request)
{
    $query = Contenu::where('status', 'validated')
                    ->where('is_active', true)
                    ->with(['langue','region','typecontenu']);

        if ($q = $request->q) {
            $query->where(function($sub) use ($q) {
                $sub->where('titre', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%");
            });
        }

    if ($request->filled('langue')) {
        $query->where('langue_id', $request->langue);
    }

    if ($request->filled('region')) {
        $query->where('region_id', $request->region);
    }

    if ($request->filled('type')) {
        $query->where('typecontenu_id', $request->type);
    }

    if ($request->premium === '0') {
            $query->where('is_premium', false);
        } elseif ($request->premium === '1') {
            $query->where('is_premium', true);
        }

    $contenus = $query->orderBy('published_at','desc')->paginate(9);

    return view('front.contenus.index', [
            'contenus' => $query->latest()->paginate(12),
            'langues'  => Langue::orderBy('nom')->get(),
            'typecontenus'    => TypeContenu::orderBy('nom')->get(),
            'regions'  => Region::orderBy('nom')->get(),
        ]);
}


    public function show($slug)
    {
        $contenu = Contenu::with(['langue','region','typecontenu','medias','commentaires'])
            ->where('slug', $slug)
            ->valideS()
            ->firstOrFail();

        $user = auth()->user();
        $accessible = $contenu->est_accessible;

        // On incrémente les vues
        $contenu->increment('vues_total');



        return view('front.contenus.show', compact('contenu','accessible','user'));
    }
}
