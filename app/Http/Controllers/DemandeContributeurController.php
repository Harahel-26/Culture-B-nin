<?php

namespace App\Http\Controllers;

use App\Models\DemandeContributeur;
use Illuminate\Http\Request;

class DemandeContributeurController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    // Formulaire pour un lecteur
    public function create()
    {
        return view('demandes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'motif' => 'nullable|string'
        ]);

        // Empêcher une 2ème demande si déjà en attente
        if (DemandeContributeur::where('user_id', auth()->id())
                               ->where('status', 'pending')
                               ->exists()) {
            return back()->with('error', 'Vous avez déjà une demande en cours.');
        }

        DemandeContributeur::create([
            'user_id' => auth()->id(),
            'motif' => $request->motif,
        ]);

        return redirect()->back()->with('success', 'Votre demande a été envoyée.');
    }

    // LISTE ADMIN
    public function index()
    {
        $this->authorizeRole(['admin', 'moderateur']);

        $demandes = DemandeContributeur::with(['user','validateur'])
                        ->orderBy('created_at','desc')
                        ->paginate(20);

        return view('admin.demandes.index', compact('demandes'));
    }

    // Approver
    public function approuver(DemandeContributeur $demande)
    {
        $this->authorizeRole(['admin', 'moderateur']);

        $demande->update([
            'status' => 'approved',
            'validated_by' => auth()->id(),
        ]);

        // Ajout du rôle contributeur
        $demande->user->assignRole('contributeur');

        return redirect()->back()->with('success', 'Demande approuvée.');
    }

    // Rejeter
    public function rejeter(DemandeContributeur $demande)
    {
        $this->authorizeRole(['admin', 'moderateur']);

        $demande->update([
            'status' => 'rejected',
            'validated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Demande rejetée.');
    }

    private function authorizeRole($roles)
    {
        if(!auth()->user()->hasRole($roles)){
            abort(403);
        }
    }
}
