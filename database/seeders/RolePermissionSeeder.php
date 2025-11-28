<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Création des rôles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $moderateur = Role::firstOrCreate(['name' => 'moderateur']);
        $contributeur = Role::firstOrCreate(['name' => 'contributeur']);
        $lecteur = Role::firstOrCreate(['name' => 'lecteur']);

        // Permissions essentielles
        $permissions = [
            'voir contenus',
            'ajouter contenus',
            'modifier contenus',
            'supprimer contenus',
            'valider contenus',
            'ajouter traductions',
            'modérer commentaires',
            'gerer utilisateurs',
            'gerer langues',
            'gerer regions',
            'gerer types contenus',
            'gerer medias'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Attribution des permissions

        // ADMIN = toutes
        $admin->givePermissionTo(Permission::all());

        // MODÉRATEUR
        $moderateur->givePermissionTo([
            'voir contenus',
            'valider contenus',
            'modérer commentaires',
        ]);

        // CONTRIBUTEUR
        $contributeur->givePermissionTo([
            'voir contenus',
            'ajouter contenus',
            'ajouter traductions'
        ]);

        // LECTEUR
        $lecteur->givePermissionTo([
            'voir contenus'
        ]);
    }
}
