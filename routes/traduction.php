<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContenuTraductionController;


// ROUTES POUR LES TRADUCTIONS
Route::middleware(['auth'])->group(function () {

    // Liste des traductions (admin, modérateur, traducteur)
    Route::get('/traductions',
        [ContenuTraductionController::class, 'index']
    )->name('traductions.index');

    // Créer une traduction (traducteur)
    Route::get('/contenus/{contenu}/traductions/create',
        [ContenuTraductionController::class, 'create']
    )->name('traductions.create');

    Route::post('/traductions',
        [ContenuTraductionController::class, 'store']
    )->name('traductions.store');

    // Voir une traduction (tous rôles)
    Route::get('/traductions/{traduction}',
        [ContenuTraductionController::class, 'show']
    )->name('traductions.show');

    // Modifier une traduction (traducteur uniquement)
    Route::get('/traductions/{traduction}/edit',
        [ContenuTraductionController::class, 'edit']
    )->name('traductions.edit');

    Route::put('/traductions/{traduction}',
        [ContenuTraductionController::class, 'update']
    )->name('traductions.update');

    // Supprimer une traduction (admin + modérateur)
    Route::delete('/traductions/{traduction}',
        [ContenuTraductionController::class, 'destroy']
    )->name('traductions.destroy');

    // Validation / rejet par admin & modérateur
    Route::put('/traductions/{traduction}/valider',
        [ContenuTraductionController::class, 'valider']
    )->name('traductions.valider');

    Route::put('/traductions/{traduction}/rejeter',
        [ContenuTraductionController::class, 'rejeter']
    )->name('traductions.rejeter');

});
