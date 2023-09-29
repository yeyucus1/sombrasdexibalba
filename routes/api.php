<?php


use App\Http\Controllers\Api\ArtworkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Rutas de Obras
Route::prefix('/artwork')->group( function () {

    //Store
    Route::post('/', [ArtworkController::class, 'store'])
        ->name('api.artwork.store');

    //Update
    Route::put('/update/{id}', [ArtworkController::class, 'update'])
        ->name('api.artwork.update');

    //Index
    //Obtener todas las obras publicadas
    Route::get('/', [ArtworkController::class, 'index'])
        ->name('api.artwork.index');

    //MyArtworks
    //Obtener todas las obras del usuario
    Route::post('/mine', [ArtworkController::class, 'myArtworks'])
        ->name('api.artwork.mine');

    Route::prefix('/info')->group(function () {

        Route::get('/author', [ArtworkController::class, 'getAuthor'])
            ->name('api.artworks.info.author');

        Route::get('/protagonist', [ArtworkController::class, 'getProtagonist'])
            ->name('api.artworks.info.protagonist');

        //Ratings Routes
        Route::prefix('/rating')->group(function () {

            // Get averange of all ratings
            Route::get('/avgRatings', [ArtworkController::class, 'getAVGRatings'])
                ->name('api.artwork.get-avg-ratings');

            // Get all ratings
            Route::get('/allRatings', [ArtworkController::class, 'getAllRatings'])
                ->name('api.artwork.get-all-ratings');
            // Get personal rating
            Route::get('/getRating', [ArtworkController::class, 'getRating'])
                ->name('api.artwork.get-rating');
            //setRating
            Route::post('/setRating', [ArtworkController::class, 'setRating'])
                ->name('api.artwork.setRating');
        });

        Route::prefix('/comments')->group( function () {

            Route::get('/getAllComments', [ArtworkController::class, 'getComments'])
                ->name('api.artwork.allComments');

            Route::get('/getMyComments', [ArtworkController::class, 'getComments'])
                ->name('api.artwork.myComment');

            Route::get('/setComment', [ArtworkController::class, 'getComments'])
                ->name('api.artwork.setComment');
        });

    });


});
