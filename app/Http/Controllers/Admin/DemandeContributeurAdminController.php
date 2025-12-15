<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemandeRole;
use Illuminate\Http\Request;

class DemandeContributeurAdminController extends Controller
{
    public function index()
    {
        // Récupérer toutes les demandes avec l'utilisateur associé
        $demandes = DemandeRole::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.demandes.index', compact('demandes'));
    }

    public function accepter(DemandeRole $demande)
    {
        $demande->update([
            'status' => 'accepted',
            'validated_by' => auth()->id(),
        ]);

        // Donner le rôle contributeur
        $demande->user->assignRole('contributeur');

        return back()->with('success', 'Demande approuvée. Le rôle contributeur a été attribué.');
    }

    public function rejeter(DemandeRole $demande)
    {
        $demande->update([
            'status' => 'rejected',
            'validated_by' => auth()->id(),
        ]);

        return back()->with('success', 'Demande rejetée.');
    }
}
