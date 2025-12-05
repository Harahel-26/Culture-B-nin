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

    public function index(Request $request)
    {
        $query = Paiement::with(['user', 'contenu'])
                        ->orderBy('created_at', 'desc');

        // Filtre statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filtre passerelle
        if ($request->filled('gateway')) {
            $query->where('gateway', $request->gateway);
        }

        $paiements = $query->paginate(15);

        // Statistiques globales
        $stats = [
            'total'     => Paiement::count(),
            'paye'      => Paiement::where('statut', 'paye')->count(),
            'en_attente'=> Paiement::where('statut', 'en_attente')->count(),
            'echec'     => Paiement::where('statut', 'echec')->count(),
        ];

        return view('admin.paiements.index', compact('paiements', 'stats'));
    }

    public function show(Paiement $paiement)
    {
        return view('admin.paiements.show', compact('paiement'));
    }
}
