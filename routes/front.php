<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ContenuController;
use App\Http\Controllers\Front\MediaController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Front\ExploreController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Routes pour la partie publique du site.
|
*/

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('front.accueil');

/*
|--------------------------------------------------------------------------
| Routes pour les contenus
|--------------------------------------------------------------------------
*/
Route::prefix('contenus')->group(function () {
    Route::get('/', [ContenuController::class, 'index'])->name('front.contenus.index'); // Liste des contenus
    Route::get('/{slug}', [ContenuController::class, 'show'])->name('front.contenus.show'); // Détail d'un contenu
});

/*
|--------------------------------------------------------------------------
| Routes pour les médias
|--------------------------------------------------------------------------
*/
Route::prefix('medias')->group(function () {
    Route::get('/', [MediaController::class, 'index'])->name('front.medias.index'); // Liste des médias
    Route::get('/images', [MediaController::class, 'images'])->name('front.medias.images'); // Images
    Route::get('/videos', [MediaController::class, 'videos'])->name('front.medias.videos'); // Vidéos
    Route::get('/audios', [MediaController::class, 'audios'])->name('front.medias.audios'); // Audios
});

/*
|--------------------------------------------------------------------------
| Route pour la recherche
|--------------------------------------------------------------------------
*/
Route::get('/recherche', [SearchController::class, 'index'])->name('front.search');


/*
|--------------------------------------------------------------------------
| Routes pour l'exploration (catégories, régions, langues)
|--------------------------------------------------------------------------
*/
Route::prefix('categories')->group(function () {
    Route::get('/', [ExploreController::class, 'categories'])->name('front.categories'); // Liste des catégories
    Route::get('/{slug}', [ExploreController::class, 'categorieShow'])->name('front.categorie.show'); // Détail d'une catégorie
});

Route::prefix('regions')->group(function () {
    Route::get('/', [ExploreController::class, 'regions'])->name('front.regions'); // Liste des régions
    Route::get('/{slug}', [ExploreController::class, 'regionShow'])->name('front.region.show'); // Détail d'une région
});

Route::prefix('langues')->group(function () {
    Route::get('/', [ExploreController::class, 'langues'])->name('front.langues'); // Liste des langues
    Route::get('/{code}', [ExploreController::class, 'langueShow'])->name('front.langue.show'); // Détail d'une langue
});

