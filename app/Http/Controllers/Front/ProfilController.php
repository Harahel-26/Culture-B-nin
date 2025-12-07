<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        return view('front.profil.index');
    }

    public function edit()
    {
        return view('front.profil.edit');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'phone'  => 'nullable|string|max:50',
            'adresse'=> 'nullable|string|max:255',
            'bio'    => 'nullable|string|max:500',
            'avatar' => 'nullable|image|max:4096',
        ]);

        // Upload avatar
        if ($request->hasFile('avatar')) {

            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        // Vérifier mot de passe actuel
        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->with('error', 'Mot de passe actuel incorrect.');
        }

        $user->update([
            'password' => Hash::make($data['password'])
        ]);

        return back()->with('success', 'Mot de passe modifié avec succès.');
    }
}
