<?php
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FavoriController;
use App\Http\Controllers\Front\AchatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ContenuController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Front\ProfilController;
    use App\Http\Controllers\Admin\PaiementController;
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

Route::get('/paiement/callback', [App\Http\Controllers\Front\PaiementController::class, 'callback'])
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

Route::post('/commentaires', [\App\Http\Controllers\Front\CommentaireController::class, 'store'])
    ->middleware(['auth', 'throttle:10,1']) // max 10 coms / minute
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
    Route::get('/profil', [\App\Http\Controllers\Front\ProfilController::class, 'index'])
        ->name('front.profil.index');

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
    Route::get('/admin/contenus/{contenu}/valider',
        [\App\Http\Controllers\Admin\ContenuController::class, 'valider'])
        ->name('contenus.valider');

    Route::get('/admin/contenus/{contenu}/rejeter',
        [\App\Http\Controllers\Admin\ContenuController::class, 'rejeter'])
        ->name('contenus.rejeter');
    Route::resource('langues', \App\Http\Controllers\Admin\LangueController::class);
    Route::resource('regions', \App\Http\Controllers\Admin\RegionController::class);
    Route::resource('typecontenus', \App\Http\Controllers\Admin\TypeContenuController::class);
    Route::resource('medias', \App\Http\Controllers\Admin\MediaController::class);
    Route::get('/admin/medias/{media}/valider',
        [\App\Http\Controllers\Admin\MediaController::class, 'valider'])
        ->name('medias.valider');

    Route::get('/admin/medias/{media}/rejeter',
        [\App\Http\Controllers\Admin\MediaController::class, 'rejeter'])
        ->name('medias.rejeter');

    Route::resource('typemedias', \App\Http\Controllers\Admin\TypeMediaController::class);

    // Commentaires admin
    Route::get('/commentaires', [\App\Http\Controllers\Admin\CommentaireController::class, 'index'])->name('commentaires.index');
    Route::get('/commentaires/{id}', [\App\Http\Controllers\Admin\CommentaireController::class, 'show'])->name('commentaires.show');
    Route::post('/commentaires/{id}/valider', [\App\Http\Controllers\Admin\CommentaireController::class, 'valider'])->name('commentaires.valider');
    Route::post('/commentaires/{id}/rejeter', [\App\Http\Controllers\Admin\CommentaireController::class, 'rejeter'])->name('commentaires.rejeter');
    Route::delete('/commentaires/{id}', [\App\Http\Controllers\Admin\CommentaireController::class, 'destroy'])->name('commentaires.destroy');
});




Route::prefix('admin')->middleware(['auth','role:admin'])->group(function () {
    Route::get('paiements', [PaiementController::class, 'index'])->name('admin.paiements.index');
    Route::get('paiements/{paiement}', [PaiementController::class, 'show'])->name('admin.paiements.show');
});




//-----------------------------------------
// DASHBOARD CONTRIBUTEUR
//-----------------------------------------

Route::middleware(['auth', 'role:contributeur'])->group(function () {

    Route::get('/contributeur/dashboard',
        [\App\Http\Controllers\Front\Contributeur\DashboardController::class, 'index']
    )->name('contributeur.dashboard');

    Route::get('/contributeur/contenus',
        [\App\Http\Controllers\Front\Contributeur\ContenuController::class, 'index']
    )->name('contributeur.contenus.index');

    Route::get('/contributeur/contenus/create',
        [\App\Http\Controllers\Front\Contributeur\ContenuController::class, 'create']
    )->name('contributeur.contenus.create');

    Route::post('/contributeur/contenus',
        [\App\Http\Controllers\Front\Contributeur\ContenuController::class, 'store']
    )->name('contributeur.contenus.store');
    Route::get('/contributeur/contenus/{contenu}/traductions/create',
        [\App\Http\Controllers\Front\Contributeur\TraductionController::class, 'create'])
        ->name('contributeur.traductions.create');

    Route::post('/contributeur/contenus/{contenu}/traductions',
        [\App\Http\Controllers\Front\Contributeur\TraductionController::class, 'store'])
        ->name('contributeur.traductions.store');
});


// Demande pour devenir contributeur
Route::middleware(['auth'])->group(function () {

    Route::get('/profil/devenir-contributeur',
        [\App\Http\Controllers\Front\DemandeContributeurController::class, 'form'])
        ->name('front.devenir.form');

    Route::post('/profil/devenir-contributeur',
        [\App\Http\Controllers\Front\DemandeContributeurController::class, 'store'])
        ->name('front.devenir.store');

});


// ESPACE MODÉRATEUR
//---------------------------------------------
Route::middleware(['auth', 'role:moderateur'])->prefix('moderateur')->group(function () {

    Route::get('/dashboard',
        [\App\Http\Controllers\Moderateur\DashboardController::class, 'index']
    )->name('moderateur.dashboard');

    // Contenus en attente
    Route::get('/contenus/en-attente',
        [\App\Http\Controllers\Moderateur\ContenuModerationController::class, 'index']
    )->name('moderateur.contenus.pending');

    Route::post('/contenus/{contenu}/valider',
        [\App\Http\Controllers\Moderateur\ContenuModerationController::class, 'valider']
    )->name('moderateur.contenus.valider');

    Route::post('/contenus/{contenu}/rejeter',
        [\App\Http\Controllers\Moderateur\ContenuModerationController::class, 'rejeter']
    )->name('moderateur.contenus.rejeter');

    // Médias en attente
    Route::get('/medias/en-attente',
        [\App\Http\Controllers\Moderateur\MediaModerationController::class, 'index']
    )->name('moderateur.medias.pending');

    Route::post('/medias/{media}/valider',
        [\App\Http\Controllers\Moderateur\MediaModerationController::class, 'valider']
    )->name('moderateur.medias.valider');

    Route::post('/medias/{media}/rejeter',
        [\App\Http\Controllers\Moderateur\MediaModerationController::class, 'rejeter']
    )->name('moderateur.medias.rejeter');

    // Commentaires en attente
    Route::get('/commentaires/en-attente',
        [\App\Http\Controllers\Moderateur\CommentaireModerationController::class, 'index']
    )->name('moderateur.commentaires.pending');

    Route::post('/commentaires/{commentaire}/valider',
        [\App\Http\Controllers\Moderateur\CommentaireModerationController::class, 'valider']
    )->name('moderateur.commentaires.valider');

    Route::post('/commentaires/{commentaire}/rejeter',
        [\App\Http\Controllers\Moderateur\CommentaireModerationController::class, 'rejeter']
    )->name('moderateur.commentaires.rejeter');

    // Traductions en attente
    Route::get('/traductions/en-attente',
        [\App\Http\Controllers\Moderateur\TraductionModerationController::class, 'index']
    )->name('moderateur.traductions.pending');

    Route::post('/traductions/{trad}/valider',
        [\App\Http\Controllers\Moderateur\TraductionModerationController::class, 'valider']
    )->name('moderateur.traductions.valider');

    Route::post('/traductions/{trad}/rejeter',
        [\App\Http\Controllers\Moderateur\TraductionModerationController::class, 'rejeter']
    )->name('moderateur.traductions.rejeter');

});

Route::middleware(['auth', 'role:admin|moderateur'])->group(function () {

    Route::get('/admin/demandes',
        [\App\Http\Controllers\Admin\DemandeContributeurAdminController::class, 'index'])
        ->name('admin.demandes.index');

    Route::post('/admin/demandes/{demande}/accepter',
        [\App\Http\Controllers\Admin\DemandeContributeurAdminController::class, 'accepter'])
        ->name('admin.demandes.accepter');

    Route::post('/admin/demandes/{demande}/rejeter',
        [\App\Http\Controllers\Admin\DemandeContributeurAdminController::class, 'rejeter'])
        ->name('admin.demandes.rejeter');

});

// ADMIN - TRADUCTIONS
Route::middleware(['auth', 'role:admin|moderateur'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/traductions', [\App\Http\Controllers\Admin\TraductionController::class, 'index'])
        ->name('traductions.index');

    Route::get('/traductions/{trad}', [\App\Http\Controllers\Admin\TraductionController::class, 'show'])
        ->name('traductions.show');

    Route::post('/traductions/{trad}/valider', [\App\Http\Controllers\Admin\TraductionController::class, 'valider'])
        ->name('traductions.valider');

    Route::post('/traductions/{trad}/rejeter', [\App\Http\Controllers\Admin\TraductionController::class, 'rejeter'])
        ->name('traductions.rejeter');
});

/*
|--------------------------------------------------------------------------
| PAGES STATIQUES (Front)
|--------------------------------------------------------------------------
*/

Route::get('/apropos', function () {
    return view('front.pages.apropos');
})->name('front.apropos');

Route::get('/contact', function () {
    return view('front.pages.contact');
})->name('front.contact');



Route::post('/contact/send', [ContactController::class, 'send'])
    ->middleware('throttle:5,2') // 5 messages / 2 minutes max
    ->name('front.contact.send');



/*
|--------------------------------------------------------------------------
| Auth (Breeze/Fortify)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
