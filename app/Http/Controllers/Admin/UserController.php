<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * LISTE DES UTILISATEURS
     */
    public function index()
    {
        $utilisateurs = User::orderBy('created_at', 'desc')
                            ->with('roles')
                            ->paginate(10);

        return view('admin.utilisateurs.index', compact('utilisateurs'));
    }

    /**
     * FORMULAIRE DE CRÉATION
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.utilisateurs.create', compact('roles'));
    }

    /**
     * ENREGISTRER UTILISATEUR
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'prenom'    => 'required|string|max:255',
            'nom'       => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:8|confirmed',
            'role'      => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'prenom'   => $data['prenom'],
            'nom'      => $data['nom'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Attribution rôle
        $role = Role::find($data['role']);
        $user->assignRole($role->name);

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * AFFICHER UN UTILISATEUR
     */
    public function show(User $utilisateur)
    {
        return view('admin.utilisateurs.show', compact('utilisateur'));
    }

    /**
     * FORMULAIRE EDIT
     */
    public function edit(User $utilisateur)
    {
        $roles = Role::all();

        return view('admin.utilisateurs.edit', compact('utilisateur', 'roles'));
    }

    /**
     * METTRE À JOUR
     */
    public function update(Request $request, User $utilisateur)
    {
        $data = $request->validate([
            'prenom'    => 'required|string|max:255',
            'nom'       => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $utilisateur->id,
            'password'  => 'nullable|string|min:8|confirmed',
            'role'      => 'required|exists:roles,id',
        ]);

        // Update infos
        $utilisateur->update([
            'prenom'  => $data['prenom'],
            'nom'     => $data['nom'],
            'email'   => $data['email'],
            'password'=> $data['password']
                            ? Hash::make($data['password'])
                            : $utilisateur->password,
        ]);

        // Update rôle
        $role = Role::find($data['role']);
        $utilisateur->syncRoles([$role->name]);

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * SUPPRESSION
     */
    public function destroy(User $utilisateur)
    {
        $utilisateur->delete();

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}
