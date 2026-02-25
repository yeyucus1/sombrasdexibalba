<?php

namespace App\Http\Controllers;

use App\Models\artworks;
use Illuminate\Http\Request;

class ArtworkShowAll extends Controller
{
   public function index()
{
    $artworks = artworks::orderBy('created_at', 'desc')->get();

    return view('artworks.all', compact('artworks'));
}

}
