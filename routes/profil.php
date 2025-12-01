
<?php
use App\Http\Controllers\Front\ProfilController;

Route::middleware(['auth'])->group(function () {
    Route::get('/mon-profil', [ProfilController::class, 'index'])->name('front.profil');
    Route::get('/mon-profil/edit', [ProfilController::class, 'edit'])->name('front.profil.edit');
    Route::post('/mon-profil/update', [ProfilController::class, 'update'])->name('front.profil.update');

    // Mes contenus
    Route::get('/mon-profil/mes-contenus', [ProfilController::class, 'contenus'])->name('front.profil.contenus');

    // Mes traductions
    Route::get('/mon-profil/mes-traductions', [ProfilController::class, 'traductions'])->name('front.profil.traductions');

    // Mes commentaires
    Route::get('/mon-profil/mes-commentaires', [ProfilController::class, 'commentaires'])->name('front.profil.commentaires');

    // Demande pour devenir contributeur
    Route::post('/mon-profil/demande-contributeur', [ProfilController::class, 'demandeContributeur'])->name('front.profil.demande-contributeur');
});
