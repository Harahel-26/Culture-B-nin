<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LangueController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\TypeContenuController;
use App\Http\Controllers\Admin\TypeMediaController;
use App\Http\Controllers\Admin\ContenuController;
use App\Http\Controllers\ContenuTraductionController;
use App\Http\Controllers\DemandeContributeurController;
use App\Http\Controllers\DemandeContributeurUserController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\CommentaireController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Toutes les routes pour la gestion de l'administration.
|
*/

// Routes pour les commentaires
Route::prefix('admin')->middleware(['auth', 'role:admin|moderateur'])->group(function () {
    Route::get('commentaires', [CommentaireController::class, 'index'])->name('admin.commentaires.index');
    Route::get('commentaires/{commentaire}', [CommentaireController::class, 'show'])->name('admin.commentaires.show');
    Route::put('commentaires/{commentaire}/valider', [CommentaireController::class, 'valider'])->name('admin.commentaires.valider');
    Route::put('commentaires/{commentaire}/rejeter', [CommentaireController::class, 'rejeter'])->name('admin.commentaires.rejeter');
    Route::delete('commentaires/{commentaire}', [CommentaireController::class, 'destroy'])->name('admin.commentaires.destroy');
});
//Gestion des utilisateurs
route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('utilisateurs', UserController::class);

});



// Routes principales pour les ressources administratives
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Gestion des utilisateurs
    Route::resource('users', UserController::class);

    // Gestion des régions
    Route::resource('regions', RegionController::class);

    // Gestion des langues
    Route::resource('langues', LangueController::class);

    // Gestion des types de contenus
    Route::resource('typecontenus', TypeContenuController::class);

    // Gestion des types de médias
    Route::resource('typemedias', TypeMediaController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])
     ->name('dashboards.index')
        ->middleware('role:admin|moderateur');


    // Gestion des contenus
    Route::resource('contenus', ContenuController::class)->middleware('role:admin|moderateur');
    Route::put('contenus/{contenu}/valider', [ContenuController::class, 'valider'])->name('contenus.valider');
    Route::put('contenus/{contenu}/rejeter', [ContenuController::class, 'rejeter'])->name('contenus.rejeter');

    // Gestion des médias
    Route::resource('medias', MediaController::class)->middleware('role:admin|moderateur')->except(['edit', 'update']);
    Route::put('medias/{media}/valider', [MediaController::class, 'valider'])->name('medias.valider');
    Route::put('medias/{media}/rejeter', [MediaController::class, 'rejeter'])->name('medias.rejeter');
});

// Routes pour la gestion des demandes de contributeurs
Route::prefix('admin')->middleware(['auth', 'role:admin|moderateur'])->group(function () {
    Route::get('/demandes-contributeurs', [DemandeContributeurController::class, 'index'])->name('admin.demandes.index');
    Route::put('/demandes-contributeurs/{demande}/approuver', [DemandeContributeurController::class, 'approuver'])->name('admin.demandes.approuver');
    Route::put('/demandes-contributeurs/{demande}/rejeter', [DemandeContributeurController::class, 'rejeter'])->name('admin.demandes.rejeter');
});


