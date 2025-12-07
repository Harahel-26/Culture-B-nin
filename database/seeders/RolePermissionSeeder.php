<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ------------------------
        //  PERMISSIONS
        // ------------------------
        $permissions = [

            // LECTEUR
            'voir-contenus',
            'commenter',
            'noter',
            'favoris',

            // CONTRIBUTEUR
            'creer-contenu',
            'modifier-contenu',
            'supprimer-contenu',

            'uploader-media',
            'supprimer-media',

            'proposer-traduction',

            // MODÉRATEUR
            'valider-contenu',
            'rejeter-contenu',

            'valider-media',
            'rejeter-media',

            'valider-commentaire',
            'rejeter-commentaire',

            'valider-traduction',
            'rejeter-traduction',

            // ADMIN (gère tout)
            'gerer-langues',
            'gerer-regions',
            'gerer-typecontenu',
            'gerer-typemedia',
            'gerer-users',
            'gerer-paiements',

        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // ------------------------
        //  ROLES
        // ------------------------

        $admin        = Role::firstOrCreate(['name' => 'admin']);
        $moderateur   = Role::firstOrCreate(['name' => 'moderateur']);
        $contributeur = Role::firstOrCreate(['name' => 'contributeur']);
        $lecteur      = Role::firstOrCreate(['name' => 'lecteur']);

        // ------------------------
        //  ATTRIBUTION
        // ------------------------

        // LECTEUR
        $lecteur->givePermissionTo([
            'voir-contenus',
            'commenter',
            'noter',
            'favoris',
        ]);

        // CONTRIBUTEUR
        $contributeur->givePermissionTo([
            'voir-contenus',
            'commenter',
            'noter',
            'favoris',

            'creer-contenu',
            'modifier-contenu',
            'supprimer-contenu',

            'uploader-media',
            'supprimer-media',

            'proposer-traduction',
        ]);

        // MODÉRATEUR
        $moderateur->givePermissionTo([
            'voir-contenus',

            'valider-contenu',
            'rejeter-contenu',

            'valider-media',
            'rejeter-media',

            'valider-commentaire',
            'rejeter-commentaire',

            'valider-traduction',
            'rejeter-traduction',
        ]);

        // ADMIN → tout
        $admin->givePermissionTo(Permission::all());
    }
}
