<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ContenuController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Front\ProfilController;
use App\Http\Controllers\Front\PaiementController;
use App\Http\Controllers\Front\CommentaireController;
use App\Http\Controllers\Front\MediaController;
use App\Http\Controllers\Front\DemandeContributeurUserController;
use App\Http\Controllers\Admin\DashboardController;




/*
|--------------------------------------------------------------------------
| Page d'accueil du front
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('front.accueil');

/*
|--------------------------------------------------------------------------
| Routes PUBLIQUES (tout le monde peut voir)
|--------------------------------------------------------------------------
*/

// 1. LISTE DES CONTENUS (AJOUTÉ)
Route::get('/contenus', [ContenuController::class, 'index'])->name('front.contenus.index');

// 2. DÉTAIL D'UN CONTENU
Route::get('/contenu/{slug}', [ContenuController::class, 'show'])->name('front.contenus.show');

// 3. FILTRES
Route::get('/categorie/{slug}', [ContenuController::class, 'parCategorie'])->name('front.contenus.categorie');
Route::get('/region/{slug}', [ContenuController::class, 'parRegion'])->name('front.contenus.region');
Route::get('/langue/{code}', [ContenuController::class, 'parLangue'])->name('front.contenus.langue');

// 4. RECHERCHE
Route::get('/recherche', [SearchController::class, 'index'])->name('front.search');
// 5. MÉDIAS
// Routes pour les médias (à mettre dans les routes publiques)
Route::prefix('medias')->name('front.medias.')->group(function () {
    Route::get('/', [MediaController::class, 'index'])->name('index');
    Route::get('/images', [MediaController::class, 'images'])->name('images');
    Route::get('/videos', [MediaController::class, 'videos'])->name('videos');
    Route::get('/audios', [MediaController::class, 'audios'])->name('audios');
});

/*
|--------------------------------------------------------------------------
| Routes PROTÉGÉES (nécessite connexion)
|--------------------------------------------------------------------------
*/

// COMMENTAIRES
Route::middleware(['auth'])->prefix('commentaires')->name('front.commentaires.')->group(function () {
    Route::post('/', [CommentaireController::class, 'store'])->name('store');
    Route::delete('/{commentaire}', [CommentaireController::class, 'destroy'])->name('destroy');
});

// PROFIL UTILISATEUR
Route::middleware(['auth'])->prefix('profil')->name('front.profil.')->group(function () {
    Route::get('/', [ProfilController::class, 'index'])->name('index');
    Route::get('/edit', [ProfilController::class, 'edit'])->name('edit');
    Route::post('/update', [ProfilController::class, 'update'])->name('update');
    Route::get('/contenus', [ProfilController::class, 'contenus'])->name('contenus');
    Route::get('/traductions', [ProfilController::class, 'traductions'])->name('traductions');
    Route::get('/commentaires', [ProfilController::class, 'commentaires'])->name('commentaires');
    Route::post('/demande-contributeur', [ProfilController::class, 'demandeContributeur'])->name('demande-contributeur');
});

// DEVENIR CONTRIBUTEUR
Route::middleware(['auth'])->prefix('devenir-contributeur')->group(function () {
    Route::get('/', [DemandeContributeurUserController::class, 'form'])->name('contributeur.form');
    Route::post('/', [DemandeContributeurUserController::class, 'store'])->name('contributeur.store');
    Route::get('/mes-demandes', [DemandeContributeurUserController::class, 'mesDemandes'])->name('contributeur.mes-demandes');
});

// PAIEMENTS
Route::middleware(['auth'])->prefix('paiement')->name('front.paiement.')->group(function () {
    Route::get('/{contenu}', [PaiementController::class, 'init'])->name('init');
    Route::post('/{contenu}/process', [PaiementController::class, 'process'])->name('process');
    Route::get('/success/{reference}', [PaiementController::class, 'success'])->name('success');
    Route::get('/failed/{reference}', [PaiementController::class, 'failed'])->name('failed');
});

/*
|--------------------------------------------------------------------------
| Admin (nécessite rôle admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboards.index');

    // Ressources admin
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('contenus', \App\Http\Controllers\Admin\ContenuController::class);
    Route::resource('langues', \App\Http\Controllers\Admin\LangueController::class);
    Route::resource('regions', \App\Http\Controllers\Admin\RegionController::class);
    Route::resource('typecontenus', \App\Http\Controllers\Admin\TypeContenuController::class);
    Route::resource('medias', \App\Http\Controllers\Admin\MediaController::class);
    Route::resource('typemedias', \App\Http\Controllers\Admin\TypeMediaController::class);

    // Commentaires admin
    Route::get('/commentaires', [\App\Http\Controllers\Admin\CommentaireController::class, 'index'])->name('commentaires.index');
    Route::get('/commentaires/{id}', [\App\Http\Controllers\Admin\CommentaireController::class, 'show'])->name('commentaires.show');
    Route::post('/commentaires/{id}/valider', [\App\Http\Controllers\Admin\CommentaireController::class, 'valider'])->name('commentaires.valider');
    Route::post('/commentaires/{id}/rejeter', [\App\Http\Controllers\Admin\CommentaireController::class, 'rejeter'])->name('commentaires.rejeter');
    Route::delete('/commentaires/{id}', [\App\Http\Controllers\Admin\CommentaireController::class, 'destroy'])->name('commentaires.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth (Breeze/Fortify)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
