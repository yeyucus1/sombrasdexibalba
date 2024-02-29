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

        Route::prefix('/reviews')->group( function () {

            //str_replace('localhost','localhost:8000',route('api.artwork.allReviews')) . '?user_id=' . urlencode(base64_encode(1)) . '&artwork_id=' .urlencode(base64_encode(1))
            Route::get('/getAllReviews', [ArtworkController::class, 'getReviews'])
                ->name('api.artwork.allReviews');

            //str_replace('localhost','localhost:8000',route('api.artwork.myReview')) . '?user_id=' . urlencode(base64_encode(1)) . '&artwork_id=' .urlencode(base64_encode(1))
            Route::get('/getMyReview', [ArtworkController::class, 'getMyReview'])
                ->name('api.artwork.myReview');

            //str_replace('localhost','localhost:8000',route('api.artwork.setReview')) . '?user_id=' . urlencode(base64_encode(1)) . '&artwork_id=' .urlencode(base64_encode(1)) . '&current_user=' . urlencode(base64_encode(1)) . '&review=' . urlencode('Hola review')
            Route::get('/setReview', [ArtworkController::class, 'setReview'])
                ->name('api.artwork.setReview');
        });

    });


});
