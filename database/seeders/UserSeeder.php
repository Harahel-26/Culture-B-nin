<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {

        // Super admin
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'username' => 'admin',
                'password' => Hash::make('Admin@1234'), // Changez le mot de passe après le premier login
                'is_admin' => true,
                'is_active' => true,
            ]
        );
        $user->assignRole('admin');

        // Récupérer tous les rôles existants
        $roles = Role::all();

        // Générer des utilisateurs aléatoires avec des rôles différents
        User::factory()->count(10)->create()->each(function ($user) use ($roles) {
            $randomRole = $roles->random(); // Sélectionner un rôle aléatoire
            $user->assignRole($randomRole);
        });
    }
}
