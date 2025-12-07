<?php

namespace App\Http\Controllers\Moderateur;

use App\Http\Controllers\Controller;
use App\Models\ContenuTraduction;

class TraductionModerationController extends Controller
{
    public function index()
    {
        $trads = ContenuTraduction::where('status', 'pending')
            ->with(['contenu', 'langue', 'traducteur'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('moderateur.traductions.index', compact('trads'));
    }

    public function valider(ContenuTraduction $trad)
    {
        $trad->update([
            'status' => 'validated',
            'validated_by' => auth()->id(),
        ]);

        return back()->with('success', 'Traduction validée.');
    }

    public function rejeter(ContenuTraduction $trad)
    {
        $trad->update([
            'status' => 'rejected',
            'validated_by' => auth()->id(),
        ]);

        return back()->with('success', 'Traduction rejetée.');
    }
}
