<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemandeContributeur;
use App\Models\User;

class DemandeContributeurAdminController extends Controller
{
    public function index()
    {
        $demandes = DemandeContributeur::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.demandes.index', compact('demandes'));
    }

    public function accepter(DemandeContributeur $demande)
    {
        $demande->update([
            'statut' => 'accepted',
            'traite_par' => auth()->id()
        ]);

        // Mise à jour du rôle
        $demande->user->syncRoles(['contributeur']);

        return back()->with('success', 'Demande acceptée. L\'utilisateur est maintenant contributeur.');
    }

    public function rejeter(DemandeContributeur $demande)
    {
        $demande->update([
            'statut' => 'rejected',
            'traite_par' => auth()->id()
        ]);

        return back()->with('success', 'Demande rejetée.');
    }
}
