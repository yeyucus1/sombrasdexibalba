<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtworksController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HousesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\CharactersController;
use App\Http\Controllers\ArtworkShowAll;
use App\Http\Controllers\ArtworkPublicController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Rutas que NO necesitan autenticación
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/', [GeneralController::class, 'index'])
        ->name('home');

    Route::get('/terms', [GeneralController::class, 'terms'])
        ->name('notices.terms');

    Route::get('/privacy', [GeneralController::class, 'privacy'])
        ->name('notices.privacy');

    Route::get('/artworks/public', [ArtworksController::class, 'publicRandomArtworks'])
        ->name('guest.artwork.random');

    Route::get('/test/editor', [ArtworksController::class, 'publicTest'])
        ->name('guest.test');
});


/*
|--------------------------------------------------------------------------
| Obras públicas (ver todas)
|--------------------------------------------------------------------------
*/
Route::get('/artworks', [ArtworkShowAll::class, 'index'])
    ->name('artworks.all');


/*
|--------------------------------------------------------------------------
| Rutas con autenticación (Writer)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->prefix('writer')
    ->group(function () {

        // Inicio
        Route::get('/', [WriterController::class, 'getDetails'])
            ->name('writer.home');

        // Crear obra
        Route::get('/write', [ArtworksController::class, 'create'])
            ->name('writer.artworks.create');

        /*
        |--------------------------------------------------------------------------
        | Obras del escritor
        |--------------------------------------------------------------------------
        */
        Route::prefix('artworks')->group(function () {

            // Todas mis obras
            Route::get('/', [ArtworksController::class, 'myArtworks'])
                ->name('writer.artworks.index');

            // Editar obra
            Route::get('/edit/{artwork}', [ArtworksController::class, 'edit'])
                ->name('writer.artworks.edit');

            // Leer obra
            Route::get('/{artwork}', [ArtworksController::class, 'read'])
                ->name('writer.artworks.read');
        });

        // Casa del escritor
        Route::get('/houses', [WriterController::class, 'house'])
            ->name('writer.houses');

        /*
        |--------------------------------------------------------------------------
        | Personajes
        |--------------------------------------------------------------------------
        */
        Route::get('/character', [CharactersController::class, 'index'])
            ->name('writer.characters');

        Route::get('/character/create', [CharactersController::class, 'create'])
            ->name('writer.character.create');
    });


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

    
