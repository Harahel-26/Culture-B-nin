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


Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function(){
    Route::resource('users', UserController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('langues', LangueController::class);
    Route::resource('typecontenus', TypeContenuController::class);
    Route::resource('typemedias', TypeMediaController::class);
    Route::resource('contenus', ContenuController::class)->middleware('role:admin|moderateur');
    Route::put('contenus/{contenu}/valider',
        [ContenuController::class, 'valider'])
        ->name('contenus.valider');
    Route::put('contenus/{contenu}/rejeter',
        [ContenuController::class, 'rejeter'])
        ->name('contenus.rejeter');

    Route::resource('medias', MediaController::class)->middleware('role:admin|moderateur')->except(['edit','update']);

    Route::put('medias/{media}/valider', [MediaController::class, 'valider'])
        ->name('medias.valider');

    Route::put('medias/{media}/rejeter', [MediaController::class, 'rejeter'])
        ->name('medias.rejeter');
});





