<?php

namespace App\Http\Controllers;

use App\Models\artworks;
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

        return view('layouts.writer.pages.artworks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.writer.pages.artworks.create');
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
     * @param  \App\Models\artworks  $artworks
     * @return \Illuminate\Http\Response
     */
    public function show(artworks $artworks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\artworks  $artworks
     * @return \Illuminate\Http\Response
     */
    public function edit(artworks $artworks)
    {
        //
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
