<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WriterController extends Controller
{
    /***
     * Función para la vista principal de los escritores.
     *
     * Agregar mas información.
     *
     *
     * @author Ethan Morgue [nahum.ramirez@hotmail.com]
     * @date [08-02-22]
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getDetails() {
        /*if (auth()->user()->type()->first()->name != 'Writer') {
            abort(401);
        }*/

        $userInfo = [];

        return view('layouts.writer.pages.home', compact('userInfo'));

    }

    /***
     *
     * @return void
     */
    public function house() {

    }

    /***
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function characters() {
        return view("layouts.writer.writer");
    }
}
