<?php

use App\Http\Controllers\ArtworksController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HousesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\CharactersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Rutas Que no necesitan autenticación
 */
Route::middleware('guest')->group(function () {

    Route::get('/', [GeneralController::class, 'index'])->name('home');

    Route::get('/terms', [GeneralController::class, 'terms'])->name('notices.terms');

    Route::get('/privacy', [GeneralController::class, 'privacy'])->name('notices.privacy');

    Route::get('/artworks/public', [ArtworksController::class, 'publicRandomArtworks'])->name('guest.artwork.random');

    Route::get('/test/editor', [ArtworksController::class, 'publicTest'])->name('guest.test');

});





Route::middleware('auth')
    ->prefix('/writer')
    ->group(function () {

    // Inicio
    Route::get('/', [WriterController::class, 'getDetails'])->name('writer.home');

    // Ruta de escritores
    Route::get('/write', [ArtworksController::class, 'create'])->name('writer.artworks.create');

    //Rutas de obras
        Route::prefix('/artworks')->group(function () {

            // Ruta de Todas las obras
            Route::get('/', [ArtworksController::class, 'myArtworks'])
                ->name('writer.artworks.index');

            // Ruta de Editar Obra
            Route::get('/edit/{artwork}', [ArtworksController::class, 'edit'])
                ->name('writer.artworks.edit');

            // Ruta de Leer Obra
            Route::get('/{artwork}', [ArtworksController::class, 'read'])
                ->name('writer.artworks.read');

        });

    //Ruta de casa del escritor
    Route::get('/houses',[WriterController::class, 'house'])->name('writer.houses');

    //Ruta de personajes del escritor
    Route::get('/character', [CharactersController::class, 'index'])->name('writer.characters');
    
    


});




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


