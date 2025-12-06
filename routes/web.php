<?php
use App\Http\Controllers\Front\FavoriController;
use App\Http\Controllers\Front\AchatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ContenuController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Front\ProfilController;
use App\Http\Controllers\Front\PaiementController;
use App\Http\Controllers\Front\CommentaireController;
use App\Http\Controllers\Front\MediaController;
use App\Http\Controllers\Front\MediaGalleryController;
use App\Http\Controllers\Front\TypeContenuController as FrontTypeContenuController;
use App\Http\Controllers\Front\TypeMediaController as FrontTypeMediaController;
use App\Http\Controllers\Front\LangueController as FrontLangueController;
use App\Http\Controllers\Front\DemandeContributeurUserController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Accueil
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('front.home');

Route::get('/paiement/callback', [App\Http\Controllers\PaiementController::class, 'callback'])
    ->name('paiement.callback');
/*
|--------------------------------------------------------------------------
| Contenus (public)
|--------------------------------------------------------------------------
*/
Route::get('/contenus', [ContenuController::class, 'index'])->name('front.contenus.index');
Route::get('/contenu/{slug}', [ContenuController::class, 'show'])->name('front.contenus.show');
Route::get('/categorie/{slug}', [ContenuController::class, 'parCategorie'])->name('front.contenus.categorie');
Route::get('/region/{slug}', [ContenuController::class, 'parRegion'])->name('front.contenus.region');
Route::get('/langue/{code}', [ContenuController::class, 'parLangue'])->name('front.contenus.langue');

/*
|--------------------------------------------------------------------------
| Types de contenus (public)
|--------------------------------------------------------------------------
*/
Route::get('/types', [FrontTypeContenuController::class, 'index'])->name('front.typecontenus.index');
Route::get('/types/{slug}', [FrontTypeContenuController::class, 'show'])->name('front.typecontenus.show');

/*
|--------------------------------------------------------------------------
| Médias (public)
|--------------------------------------------------------------------------
*/
Route::get('/medias', [MediaController::class, 'index'])
    ->name('front.medias.index');

Route::get('/medias/gallery', [MediaGalleryController::class, 'index'])->name('front.medias.gallery');
Route::get('/medias/types', [FrontTypeMediaController::class, 'index'])->name('front.typemedia.index');
Route::get('/medias/types/{slug}', [FrontTypeMediaController::class, 'show'])->name('front.typemedia.show');

/*
|--------------------------------------------------------------------------
| Langues (public)
|--------------------------------------------------------------------------
*/
Route::get('/langues', [FrontLangueController::class, 'index'])->name('front.langues.index');
Route::get('/langues/{code}', [FrontLangueController::class, 'show'])->name('front.langues.show');





Route::middleware('auth')->group(function () {

    Route::post('/favoris/toggle', [FavoriController::class, 'toggle'])
        ->name('front.favoris.toggle');

    Route::get('/mes-favoris', [FavoriController::class, 'index'])
        ->name('front.favoris.index');
});

/*
|--------------------------------------------------------------------------
| Recherche (public)
|--------------------------------------------------------------------------
*/
Route::get('/recherche', [SearchController::class, 'index'])->name('front.search');

/*
|--------------------------------------------------------------------------
| Commentaires (protégé)
|--------------------------------------------------------------------------
*/

Route::post('/commentaires/store', [CommentaireController::class, 'store'])
    ->middleware('auth')
    ->name('front.commentaire.store');
    Route::delete('/{commentaire}', [CommentaireController::class, 'destroy'])->name('destroy');



Route::get('/mes-achats', [AchatController::class, 'index'])
    ->middleware('auth')
    ->name('front.mes.achats');

/*
|--------------------------------------------------------------------------
| Profil utilisateur (protégé)
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->group(function () {

    Route::get('/profil', [ProfilController::class, 'edit'])
        ->name('front.profil.edit');

    Route::post('/profil/update', [ProfilController::class, 'update'])
        ->name('front.profil.update');

    Route::post('/profil/password', [ProfilController::class, 'updatePassword'])
        ->name('front.profil.password');

});


/*
|--------------------------------------------------------------------------
| Admin (protégé, admin uniquement)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboards.index');

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
