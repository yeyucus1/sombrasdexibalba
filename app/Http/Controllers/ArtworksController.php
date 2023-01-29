<?php

namespace App\Http\Controllers;

use App\Models\artworks;
use App\Models\characters;
use App\Models\generes;
use App\Models\locations;
use App\Models\types;
use Illuminate\Http\Request;

class ArtworksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (!auth()) {
            abort(415);
        }

        $artworkTypes = types::get();
        $artworkGeneres = generes::get();
        $characters = characters::get();
        $locations = locations::get();

        return view('layouts.writer.pages.artworks.create', compact('artworkTypes', 'artworkGeneres', 'characters', 'locations'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\artworks  $artworks
     * @return \Illuminate\Http\Response
     */
    public function show($artwork){
        $selectedArtwork = artworks::with('author')
            ->where('id', $artwork)
        ->first();
        return view('layouts.writer.pages.artworks.show', compact('selectedArtwork'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\artworks  $artworks
     * @return \Illuminate\Http\Response
     */
    public function read($artwork){
        $selectedArtwork = artworks::with('author')
            ->where('id', $artwork)
        ->first();
        return view('layouts.writer.pages.artworks.read', compact('selectedArtwork'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\artworks  $artwork
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(artworks $artwork)
    {
        //Agregar gate y policy
        if (auth()->user()->id != $artwork->creator) {
            abort('415');
        }

        $artworkTypes = types::get();
        $artworkGeneres = generes::get();
        $characters = characters::get();
        $locations = locations::get();

        return view('layouts.writer.pages.artworks.edit',
            compact('artwork',
                'artworkTypes',
                'artworkGeneres',
                'characters',
                'locations'));
    }

    /**
     *
     *
     * @param Request $equest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function myArtworks (Request $equest) {
        //Agregar paginador en artworks
        //$artworks= artworks::paginate(10);
        $authorId = auth()->user()->id;
        $artworks = artworks::get();
        $myArtworks = artworks::where('creator', '=', $authorId)
            ->get();
        return view('layouts.writer.pages.artworks.index',
            compact('artworks',
            'myArtworks'
            ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\artworks  $artworks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, artworks $artworks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\artworks  $artworks
     * @return \Illuminate\Http\Response
     */
    public function destroy(artworks $artworks)
    {
        //
    }
}
