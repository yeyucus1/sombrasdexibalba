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

});
