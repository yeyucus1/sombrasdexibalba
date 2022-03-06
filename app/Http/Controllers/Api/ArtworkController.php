<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\artworks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArtworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $artworks = artworks::where('access', '=', 'public')
            ->where(function ($query) {
                $query->where('status', '=', 'finished');
                $query->where('publi_pref', 'finished');
            })
            ->orWhere(function ($query) {
                $query->where('status', 'in_process');
                $query->where('publi_pref', 'in_process');
            })
            /*Agregar en la siguiente version (No funciona bien ahora)
             * ->with(['author','author.house'])*/
            ->get();
            $artworksModified = $artworks->map(function ($item) {
                $item->author->house = 12;
                return $item;
            });


        $requestInfo = [
            'status' => 0,
            'message' => 'Ningun problema',
            'data' => $artworksModified
        ];


        return response()->json($requestInfo);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (!auth()) {
            abort('415');
        }

        $requestInfo = [
            'status' => 0,
            'message' => 'La obra se ha guardado correctamente',
            'data' => null
        ];

        $rules = [
            'title' => 'required|unique:artworks,title',
            'synopsis' => 'required',
            'content' => 'required',
            'access' => 'required|in:public,house',
            'preferences' => 'required|in:in_process,finished',
            'status' => 'required|in:in_process,finished',
            'type' => 'required|exists:types,id',
            'genere' => 'required|exists:generes,id',
            'location_id' => 'required|exists:locations,id',
            'protagonist' => 'required|exists:characters,id'
        ];

        $validatedData = Validator::make($request->all(),$rules);
        if ($validatedData->fails()) {
            $requestInfo['status'] = 1;
            $requestInfo['message'] = 'Hay algunos errores en la información, corrijalos e intentelo nuevamente';
            $requestInfo['data'] = $validatedData->errors();
        } else {
            $artwork = new artworks();
            $artwork->title = $request->title;
            $artwork->synopsis = $request->synopsis;
            $artwork->content = $request->content;
            $artwork->access = $request->access;
            $artwork->publi_pref = $request->preferences;
            $artwork->status = $request->status;
            $artwork->creator = auth()->user()->id;
            $artwork->type = $request->type;
            $artwork->genere = $request->genere;
            $artwork->location_id = $request->location_id;
            $artwork->character_id = $request->protagonist;


            if (!$artwork->save()) {
                $requestInfo['status'] = 2;
                $requestInfo['message'] = 'Ha ocurrido un error al guardar la obra, Contacta a los desarrolladore';
            }
        }

        return response()->json($requestInfo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

        if (!auth()) {
            abort(415);
        }

        $artwork = artworks::findOrFail($id);
        $user = auth()->user();
        if ($artwork->creator != $user->id) {
            abort(415);
        }



        $requestInfo = [
            'status' => 0,
            'message' => 'La obra se ha guardado correctamente',
            'data' => null
        ];

        $rules = [
            'title' => 'required|unique:artworks,title,' . $artwork->id,
            'synopsis' => 'required',
            'content' => 'required',
            'access' => 'required|in:public,house',
            'preferences' => 'required|in:in_process,finished',
            'status' => 'required|in:in_process,finished',
            'type' => 'required|exists:types,id',
            'genere' => 'required|exists:generes,id',
            'location_id' => 'required|exists:locations,id',
            'protagonist' => 'required|exists:characters,id'
        ];

        $validatedData = Validator::make($request->all(),$rules);
        if ($validatedData->fails()) {
            $requestInfo['status'] = 1;
            $requestInfo['message'] = 'Hay algunos errores en la información, corrijalos e intentelo nuevamente';
            $requestInfo['data'] = $validatedData->errors();
        } else {

            $artwork->title = $request->title;
            $artwork->synopsis = $request->synopsis;
            $artwork->content = $request->content;
            $artwork->access = $request->access;
            $artwork->publi_pref = $request->preferences;
            $artwork->status = $request->status;
            $artwork->type = $request->type;
            $artwork->genere = $request->genere;
            $artwork->location_id = $request->location_id;
            $artwork->character_id = $request->protagonist;


            if (!$artwork->save()) {
                $requestInfo['status'] = 2;
                $requestInfo['message'] = 'Ha ocurrido un error al guardar la obra, Contacta a los desarrolladore';
            }
        }

        return response()->json($requestInfo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*
     * Funciones extra a las basicas de un recurso
     */

    public function myArtworks() {
        if (!auth()) {
            abort('415');
        }

        $user = auth()->user()->id;


        $myArtworks = auth()
            ->user()
            ->artworks()
            ->with(['author', 'author.house', 'character', 'ratings'])
            ->get();
        $myArtworks = $myArtworks->map(function ($artwork) use ($user) {
            $artwork->canEdit = $artwork->creator == $user;
            return $artwork;
        });

        $requestInfo = [
            'status' => 0,
            'message' => 'Ningun problema :)',
            'data' => $myArtworks
        ];




        return response()->json($requestInfo);
    }

}
