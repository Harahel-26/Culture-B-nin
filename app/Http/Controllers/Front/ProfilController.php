<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('front.profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'bio'   => 'nullable|string|max:500',
            'avatar' => 'nullable|image|max:4096',
        ]);

        $data = $request->only('name','phone','bio');

        // Si avatar changé
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars','public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        return back()->with('success','Profil mis à jour avec succès.');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        // Vérifier si le mot de passe actuel est correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error','Mot de passe actuel incorrect.');
        }

        // Mettre à jour
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success','Mot de passe mis à jour avec succès.');
    }
}
