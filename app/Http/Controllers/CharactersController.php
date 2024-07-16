<?php

namespace App\Http\Controllers;

use App\Models\characters;
use Illuminate\Http\Request;

class CharactersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('layouts.writer.pages.characters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('layouts.writer.pages.characters.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\characters  $characters
     * @return \Illuminate\Http\Response
     */
    public function show( $characters)
    {
        //
        $selectedCharacter = characters::with('author')
        ->where('id', $characters)
    ->get();
    return view('layouts.writer.pages.characters.index', compact('selectedCharacter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\characters  $characters
     * @return \Illuminate\Http\Response
     */
    public function edit(characters $characters)
    {
        //
    }


    /**
     *
     *
     * @param Request $equest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function myCharacters (Request $equest) {
        //Agregar paginador en Characters
        //$artworks= artworks::paginate(10);
        $authorId = auth()->user()->id;
        $characters = characters::get();
        $myCharacters = characters::where('creator', '=', $authorId)
            ->get();
        return view('layouts.writer.pages.characters.index',
            compact('characters',
            'myCharacters'
            ));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\characters  $characters
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, characters $characters)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\characters  $characters
     * @return \Illuminate\Http\Response
     */
    public function destroy(characters $characters)
    {
        //
    }
}
