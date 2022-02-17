<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HousesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WriterController;
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

});





Route::middleware('auth')
    ->prefix('/writer')
    ->group(function () {

    // Inicio
    Route::get('/', [WriterController::class, 'getDetails'])->name('writer.home');


    //Ruta de casa del escritor
    Route::get('/houses',[WriterController::class, 'house'])->name('writer.houses');

    //Ruta de personajes del escritor
    Route::get('/characters', [WriterController::class, 'characters'])->name('writer.characters');


});




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


