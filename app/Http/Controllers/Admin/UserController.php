<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
{
    $users = User::with('roles')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

    // Statistiques
    $activeCount   = User::where('is_active', true)->count();
    $inactiveCount = User::where('is_active', false)->count();
    $adminCount    = User::role('admin')->count();

    return view('admin.users.index', compact(
        'users',
        'activeCount',
        'inactiveCount',
        'adminCount'
    ));
}


    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:5',
            'role'     => 'required|exists:roles,id',
            'avatar'   => 'nullable|image|max:2048',
            'phone'    => 'nullable|string|max:50',
            'adresse'  => 'nullable|string|max:255',
            'bio'      => 'nullable|string|max:500',
        ]);

        $avatar = null;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create([
            'name'     => $data['name'],
            'username' => $data['username'] ?? null,
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar'   => $avatar,
            'is_active' => true,
            'phone'    => $data['phone'] ?? null,
            'adresse'  => $data['adresse'] ?? null,
            'bio'      => $data['bio'] ?? null,
        ]);

        $user->assignRole(Role::find($data['role'])->name);

        return redirect()->route('admin.users.index')
                ->with('success', 'Utilisateur créé avec succès.');
    }




    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }




    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user','roles'));
    }




    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,' . $user->id,
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:5|confirmed',
            'role'     => 'required|exists:roles,id',
            'avatar'   => 'nullable|image|max:2048',
            'phone'    => 'nullable|string|max:50',
            'adresse'  => 'nullable|string|max:255',
            'bio'      => 'nullable|string|max:500',
        ]);

        $update = [
            'name'     => $data['name'],
            'username' => $data['username'] ?? null,
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'adresse'  => $data['adresse'] ?? null,
            'bio'      => $data['bio'] ?? null,
        ];

        if (!empty($data['password'])) {
            $update['password'] = Hash::make($data['password']);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $update['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($update);

        $user->syncRoles(Role::find($data['role'])->name);

        return redirect()->route('admin.users.index')
                ->with('success', 'Utilisateur mis à jour.');
    }




    public function destroy(User $user)
    {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                ->with('success', 'Utilisateur supprimé.');
    }




    public function toggleActive(User $user)
    {
        $user->update([
            'is_active' => !$user->is_active
        ]);

        return back()->with('success', 'Statut utilisateur mis à jour.');
    }
}
