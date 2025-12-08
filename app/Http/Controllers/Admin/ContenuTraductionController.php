<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contenu;
use App\Models\ContenuTraduction;
use App\Models\Langue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContenuTraductionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /*
    |--------------------------------------------------------------------------
    | LISTE DES TRADUCTIONS
    |--------------------------------------------------------------------------
    */
    public function index()
{
    $user = auth()->user();

    // Admin / modérateur
    if($user->hasRole(['admin','moderateur'])) {
        $traductions = ContenuTraduction::with(['contenu','langue','traducteur'])
                                        ->orderBy('created_at','desc')
                                        ->paginate(15);
    }
    // Traducteur
    else {
        $traductions = ContenuTraduction::where('traduit_par', $user->id)
                                        ->with(['contenu','langue'])
                                        ->paginate(15);
    }


    $stats = [
        'total'     => ContenuTraduction::count(),
        'pending'   => ContenuTraduction::where('status', 'pending')->count(),
        'validated' => ContenuTraduction::where('status', 'validated')->count(),
        'rejected'  => ContenuTraduction::where('status', 'rejected')->count(),
    ];

    return view('admin.traductions.index', compact('traductions', 'stats'));
}


    /*
    |--------------------------------------------------------------------------
    | CRÉER UNE NOUVELLE TRADUCTION
    |--------------------------------------------------------------------------
    */
    public function create(Contenu $contenu)
    {
        if(!auth()->user()->hasRole(['contributeur','admin','moderateur'])) {
            abort(403);
       }
        return view('admin.traductions.create', [
            'contenu' => $contenu,
            'langues' => Langue::all(),
        ]);
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasRole(['contributeur','admin','moderateur'])) {
            abort(403);
        }

        $request->validate([
            'contenu_id' => 'required|exists:contenus,id',
            'langue_id' => 'required|exists:langues,id',
            'titre' => 'nullable|string',
            'description' => 'nullable|string',
            'contenu_texte' => 'nullable|string',
        ]);

        ContenuTraduction::create([
            'contenu_id' => $request->contenu_id,
            'langue_id' => $request->langue_id,
            'titre' => $request->titre,
            'description' => $request->description,
            'contenu_texte' => $request->contenu_texte,
            'traduit_par' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('traductions.index')
                         ->with('success', 'Traduction soumise.');
    }

    /*
    |--------------------------------------------------------------------------
    | AFFICHER UNE TRADUCTION
    |--------------------------------------------------------------------------
    */
    public function show(ContenuTraduction $traduction)
    {
        return view('admin.traductions.show', compact('traduction'));
    }

    /*
    |--------------------------------------------------------------------------
    | MODIFIER SA PROPRE TRADUCTION
    |--------------------------------------------------------------------------
    */
    public function edit(ContenuTraduction $traduction)
    {
        // Seul le traducteur peut modifier
        if($traduction->traduit_par != auth()->id() ||
            !auth()->user()->hasRole(['contributeur','admin','moderateur'])
        ){
            abort(403);
        }


        return view('admin.traductions.edit', [
            'traduction' => $traduction,
            'langues' => Langue::all(),
        ]);
    }

    public function update(Request $request, ContenuTraduction $traduction)
    {
        if($traduction->traduit_par != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'langue_id' => 'required|exists:langues,id',
            'titre' => 'nullable|string',
            'description' => 'nullable|string',
            'contenu_texte' => 'nullable|string',
        ]);

        $traduction->update($request->only([
            'langue_id',
            'titre',
            'description',
            'contenu_texte'
        ]));

        // Quand on modifie → repasse en pending
        $traduction->update(['status' => 'pending']);

        return redirect()->route('traductions.index')
                         ->with('success', 'Traduction mise à jour.');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATION PAR ADMIN / MODÉRATEUR
    |--------------------------------------------------------------------------
    */
    public function valider(ContenuTraduction $traduction)
    {
        $this->authorizeRole(['admin','moderateur']);

        $traduction->update([
            'status' => 'validated',
            'validated_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Traduction validée.');
    }

    public function rejeter(ContenuTraduction $traduction)
    {
        $this->authorizeRole(['admin','moderateur']);

        $traduction->update([
            'status' => 'rejected',
            'validated_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Traduction rejetée.');
    }

    /*
    |--------------------------------------------------------------------------
    | SUPPRESSION
    |--------------------------------------------------------------------------
    */
    public function destroy(ContenuTraduction $traduction)
    {
        $this->authorizeRole(['admin','moderateur']);

        $traduction->delete();

        return redirect()->back()->with('success', 'Traduction supprimée.');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Role
    |--------------------------------------------------------------------------
    */
    private function authorizeRole($roles)
    {
        if(!auth()->user()->hasRole($roles))
            abort(403);
    }
}
