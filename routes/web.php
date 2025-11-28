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

Route::middleware(['auth'])->group(function () {

    Route::get('devenir-contributeur',
        [DemandeContributeurUserController::class, 'form'])
        ->name('demande.form');

    Route::post('devenir-contributeur',
        [DemandeContributeurUserController::class, 'store'])
        ->name('demande.store');

    Route::get('mes-demandes',
        [DemandeContributeurUserController::class, 'mesDemandes'])
        ->name('demande.mes');
});








// Demande par un lecteur
Route::get('/devenir-contributeur', [DemandeContributeurController::class, 'create'])
    ->middleware(['auth'])
    ->name('demande.create');

Route::post('/devenir-contributeur', [DemandeContributeurController::class, 'store'])
    ->middleware(['auth'])
    ->name('demande.store');

// Côté admin
Route::prefix('admin')->middleware(['auth','role:admin|moderateur'])->group(function () {
    Route::get('/demandes-contributeurs', [DemandeContributeurController::class, 'index'])
        ->name('admin.demandes.index');

    Route::put('/demandes-contributeurs/{demande}/approuver', [DemandeContributeurController::class, 'approuver'])
        ->name('admin.demandes.approuver');

    Route::put('/demandes-contributeurs/{demande}/rejeter', [DemandeContributeurController::class, 'rejeter'])
        ->name('admin.demandes.rejeter');
});



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/traduction.php';
require __DIR__.'/admin.php';
