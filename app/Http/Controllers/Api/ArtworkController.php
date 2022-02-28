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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
//        return response()->json($request->all());
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
            'creator' => 'required|exists:users,id',
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
            $artwork->creator = $request->creator;
            $artwork->type = $request->type;
            $artwork->genere = $request->genere;
            $artwork->location_id = $request->location_id;
            $artwork->character_id = $request->protagonist;


            if (!$artwork->save()) {
                $requestInfo['status'] = 2;
                $requestInfo['message'] = 'Ha ocurrido un error al guardar la carrera, Si persiste el error por favor contacte al administrador';
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
