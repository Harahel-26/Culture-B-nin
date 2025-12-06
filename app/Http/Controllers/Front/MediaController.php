<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\TypeMedia;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::with(['typeMedia','langue','contenu'])
            ->where('status', 'validated')
            ->orderBy('created_at','desc');

        if ($request->filled('type')) {
            $query->whereHas('typeMedia', function($q) use ($request) {
                $q->where('nom', $request->type);
            });
        }

        $medias = $query->paginate(12);

        $types = TypeMedia::all();

        return view('front.medias.index', compact('medias','types'));
    }
}
