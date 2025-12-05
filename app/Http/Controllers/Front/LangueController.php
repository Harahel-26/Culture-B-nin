<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Langue;

class LangueController extends Controller
{
    public function index()
    {
        $langues = Langue::where('is_active', true)
            ->orderBy('nom')
            ->get();

        return view('front.langues.index', compact('langues'));
    }

    public function show($code)
    {
        $langue = Langue::where('code', $code)
            ->where('is_active', true)
            ->firstOrFail();

        // Tous les contenus liés à cette langue
        $contenus = $langue->contenus()
            ->latest()
            ->take(12)
            ->get();

        return view('front.langues.show', compact('langue', 'contenus'));
    }
}
