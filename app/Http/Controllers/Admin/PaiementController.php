<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    // 🔹 Liste des paiements
    public function index(Request $request)
    {
        $query = Paiement::with(['user', 'contenu'])
            ->orderBy('created_at', 'desc');

        // Filtre statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filtre méthode
        if ($request->filled('methode')) {
            $query->where('methode', $request->methode);
        }

        $paiements = $query->paginate(15);

        // Stats rapides
        $stats = [
            'total'     => Paiement::count(),
            'paye'      => Paiement::where('statut', 'paye')->sum('montant'),
            'en_attente'=> Paiement::where('statut', 'en_attente')->count(),
            'echec'     => Paiement::where('statut', 'echec')->count(),
        ];

        return view('admin.paiements.index', compact('paiements', 'stats'));
    }

    // 🔹 Détail d'un paiement
    public function show(Paiement $paiement)
    {
        $paiement->load(['user', 'contenu']);

        return view('admin.paiements.show', compact('paiement'));
    }
}
