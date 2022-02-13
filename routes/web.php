<?php

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
/***
 *
 */

Route::get('/', function () {
    $team = [
        (object)[
            'name' => 'Ethan Morgue',
            'description' => 'Un tipo que por azares del destino terminó una carrera en ing. en sistemas y ahora quiere apoyar el arte.',
            'position' => 'Cofundador, desarrollador y administrador de sombras de Xibalba',
            'image' => asset('img/team/ethan_profile.jpeg'),
            'links' => (object) [
                'facebook' => 'https://www.facebook.com/profile.php?id=100068727503183',
                'instagram' => null,
                'tiktok' => null,
                'twitter' => null,
            ],
            'buy_me_a_coffee' => "<script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script><script type='text/javascript'>kofiwidget2.init('Support Me on Ko-fi', '#29abe0', 'Q5Q8ACXIN');kofiwidget2.draw();</script>"
        ],
        (object)[
            'name' => 'Ethan Morgue',
            'description' => 'Un tipo que por azares del destino terminó una carrera en ing. en sistemas y ahora quiere apoyar el arte.',
            'position' => 'Cofundador, desarrollador y administrador de sombras de Xibalba',
            'image' => asset('img/team/ethan_profile.jpeg'),
            'links' => (object) [
                'facebook' => 'https://www.facebook.com/profile.php?id=100068727503183',
                'instagram' => null,
                'tiktok' => null,
                'twitter' => null,
            ],
            'buy_me_a_coffee' => true,
            'coffee' => 'Hola'
        ],
        ];
    return view('layouts.guest.base',compact('team'));
})->name('home')->middleware('guest');



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


