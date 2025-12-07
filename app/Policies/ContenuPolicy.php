<?php

namespace App\Policies;

use App\Models\Contenu;
use App\Models\User;

class ContenuPolicy
{
    public function update(User $user, Contenu $contenu): bool
    {
        // Admin et modérateur peuvent tout modifier
        if ($user->hasRole(['admin', 'moderateur'])) {
            return true;
        }

        // Contributeur : seulement ses propres contenus
        if ($user->hasRole('contributeur') && $contenu->user_id === $user->id) {
            return true;
        }

        return false;
    }

    public function delete(User $user, Contenu $contenu): bool
    {
        // même logique que update
        return $this->update($user, $contenu);
    }
}
