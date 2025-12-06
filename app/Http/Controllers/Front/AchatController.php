<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AchatController extends Controller
{
    public function index()
    {
        $achats = auth()->user()
                        ->contenusAchetes()
                        ->with('typecontenu','langue')
                        ->orderBy('published_at','desc')
                        ->get();

        return view('front.achats.index', compact('achats'));
    }
}
