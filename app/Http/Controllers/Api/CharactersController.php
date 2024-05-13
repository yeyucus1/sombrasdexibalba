<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\characters;

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
        $characters = Characters::all();
        


            
        $requestInfo = [
            'status' => 0,
            'message' => 'Ningun problema',
            'data' => $characters
        ];


        return response()->json($requestInfo, );
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
        
        $requestInfo = [
            'status' => 0,
            'message' => 'El escenario se ha guardado',
            'data' => null
        ];

        $rules =[
            'name' => 'required|max:45',
            'lastname' => 'required|max:45',
            'age' => 'required|numeric',
            'description' => 'required',
            'family' => 'required|max:45',
            'family_description' => 'required',
            'native_city' => 'required|max:45',
            'living_city' => 'required|max:45',
            'creator' => 'exists:users,id'
        ];

        $validatedData = Validator::make($request->all(),$rules);
        if ($validatedData->fails()) {
            $requestInfo['status'] = 1;
            $requestInfo['message'] = 'Hay algunos errores en la información, corrijalos e intentelo nuevamente';
            $requestInfo['data'] = $validatedData->errors();
        }else{
            $character = new character();
            $character->name = $request->name;
            $character->lastname = $request->lastname;
            $character->age = $request->age;
            $character->description = $request->description;
            $character->family = $request->family;
            $character->family_description = $request->family_description;
            $character->native_city = $request->native_city;
            $character->living_city = $request->living_city;
            $character->creator = $request->creator;
            
            if (!$character->save()) {
                $requestInfo['status'] = 2;
                $requestInfo['message'] = 'Ha ocurrido un error al guardar el personaje, Contacta a los desarrolladore';
            }

            return response()->json($requestInfo);

        }
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
