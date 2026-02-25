<?php

namespace App\Http\Controllers;

use App\Models\artworks;   // 👈 IMPORTANTE
use Illuminate\Http\Request;

class ArtworkPublicController extends Controller
{
    /**
     * Mostrar una obra de forma pública
     */
    public function show(artworks $artwork)
    {
        return view('artworks.show', compact('artwork'));
    }
}
