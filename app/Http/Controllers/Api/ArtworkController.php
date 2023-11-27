<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\artworks;
use App\Models\ratings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $artwork->content = $request->get('content');
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
    public function update(Request $request)
    {

        $user = $request->get('user');
        $user = base64_decode($user);
        $user = User::findOrFail($user);

        $id = $request->get('user');

        $artwork = $request->get('artwork_id');
        $artwork = base64_decode($artwork);
        $artwork =artworks::findOrFail($artwork);



        if ($user->id != $artwork->creator) {
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

        $messages = [
            'title.required' => 'El campo no debe estar vacio',
            'title.unique' => 'Ya existe un titulo igual registrado',
            'synopsis.required' => 'El campo no debe estar vacio',
            'content.required' => 'El campo no debe estar vacio',
            'access.required' => 'El campo no debe estar vacio',
            'access.in' => 'El valor del campo es incorrecto',
            'preferences.required' => 'El campo no debe estar vacio',
            'preferences.in' => 'El valor del campo es incorrecto',
            'status.required' => 'El campo no debe estar vacio',
            'status.in' => 'El valor del campo es incorrecto',
            'type.required' => 'El campo no debe estar vacio',
            'type.exists' => 'El valor del campo es incorrecto',
            'genere.required' => 'El campo no debe estar vacio',
            'genere.exists' => 'El valor del campo es incorrecto',
            'location_id.required' => 'El campo no debe estar vacio',
            'location_id.exists' => 'El valor del campo es incorrecto',
            'protagonist.required' => 'El campo no debe estar vacio',
            'protagonist.exists' => 'El valor del campo es incorrecto',
        ];

        $validatedData = Validator::make($request->all(),$rules, $messages);
        if ($validatedData->fails()) {
            $requestInfo['status'] = 1;
            $requestInfo['message'] = 'Hay algunos errores en la información, corrijalos e intentelo nuevamente';
            $requestInfo['data'] = $validatedData->errors();
        } else {

            $artwork->title = $request->title;
            $artwork->synopsis = $request->synopsis;
            $artwork->content = $request->get('content');
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

    public function myArtworks(Request $request) {

        $user = $request->get('user');
        $user = User::findOrFail(base64_decode($user));


        $myArtworks = $user
            ->artworks()
            ->with(['author', 'author.house', 'protagonist', 'ratings'])
            ->get();
        $myArtworks = $myArtworks->map(function ($artwork) use ($user) {
            $artwork['artwork_id'] = base64_encode($artwork->id);
            $artwork['id'] = null;
            $artwork->canEdit = $artwork->creator == $user->id;
            return $artwork;
        });

        $requestInfo = [
            'status' => 0,
            'message' => 'Ningun problema :)',
            'data' => $myArtworks
        ];



        return response()->json($requestInfo);
    }

    public function setRating(Request $request) {

        $returnedInfo = [
            'status' => 0,
            'message' => 'To bien',
        ];

        $user = base64_decode($request->get('user'));
        $currentUser = base64_decode($request->get('currentUser'));
        $artwork = base64_decode($request->get('artwork'));
        $rating = $request->get('rating');
        if ($currentUser == $user) {
            artworks::find($artwork)->ratings()->detach($user);
            artworks::find($artwork)->ratings()->attach([
                $user =>['rating' => $rating]
            ]);
        }
        else {
            abort(419);
        }
        return $returnedInfo;
    }

    private function canSeeArtwork($user, $artwork) {
        $can = true;
        //Agregar la logica para que no permita entrar a usuarios no deseados
        return $can;
    }

    /***
     * Inician Funciones de Info de Artworks
     */

    public function getAuthor(Request $request) {
        $user = base64_decode($request->get('user_id'));
        $artwork = base64_decode($request->get('artwork_id'));
        if (!$this->canSeeArtwork($user, $artwork))
            abort(419);

        $author = artworks::findOrFail($artwork)
            ->author()
            ->with('house')
            ->first();
        $author = [
            'user' => $author->pseudonym,
            'house' => $author->house?$author->house->first()->name:''
        ];

        return $author;

    }

    public function getProtagonist(Request $request) {
        $user = base64_decode($request->get('user_id'));
        $artwork = base64_decode($request->get('artwork_id'));
        if (!$this->canSeeArtwork($user, $artwork))
            abort(419);

        $protagonist = artworks::findOrFail($artwork)
            ->protagonist()
            ->with('creator')
            ->first();

        $protagonist = [
            'fullName' => $protagonist->name . ' ' . $protagonist->lastname,
            'age' => $protagonist->age,
            'description' => $protagonist->description,
            'family' => $protagonist->family,
            'familyDescription' => $protagonist->family_description,
            'nativeCity' => $protagonist->native_city,
            'livingCity' => $protagonist->living_city,
            'author' => $protagonist->creator()->first()->pseudonym
        ];

        return $protagonist;



    }

    /***
     * Obtiene la calificaciones del usuario dado
     * @param Request $request
     * @return int
     */
    public function getRating(Request $request) {
        $user = base64_decode($request->get('user_id'));
        $artwork = base64_decode($request->get('artwork_id'));
        $rating = artworks::find($artwork)->ratings()->where('user', $user)->first();
        $user = User::findOrFail($user);
        return [
            'user' => $user->pseudonym,
            'user_id' => base64_encode($user->id),
            'rate' => $rating?$rating->pivot->rating:0
        ];
    }

    /***
     * Regresa una coleccion con las calificaciones de cada usuario, menos del usuario dado
     * @param Request $request
     * @return int
     */
    public function getAllRatings(Request $request) {
        $artwork = base64_decode($request->get('artwork_id'));
        $user = base64_decode($request->get('user_id'));
        $ratings = artworks::find($artwork)->ratings()
            ->where('user', '!=', $user)
            ->get();
        $ratings = collect($ratings->map( function ($rating) {
            return [
                'user' => $rating->pseudonym,
                'rating' => $rating->pivot->rating
                ];
        }));
        // dd($ratings->avg('rating'));

        return $ratings;

    }

    /***
     * Obtiene el promedio de las calificaciones de la obra
     * @param Request $request
     * @return int
     */
    public function getAVGRatings(Request $request) {
        $artwork = base64_decode($request->get('artwork_id'));
        $ratings = artworks::find($artwork)->ratings()->get();
        $ratings = collect($ratings->map( function ($rating) {
            return [
                'user' => $rating->pseudonym,
                'rating' => $rating->pivot->rating
                ];
        }));
        // dd($ratings->avg('rating'));

        return $ratings->avg('rating');

    }

    /***
     *
     * Inician funciones de Reviews
     *
     */

    /***
     * Funcion para agregar una reseña
     *
     *
     *
     * @param Request $request
     * @return array
     */
    public function setReview(Request $request) {

        $returnedInfo = [
            'status' => 0,
            'message' => 'To bien',
        ];

        $user = base64_decode($request->get('user'));
        $currentUser = base64_decode($request->get('currentUser'));
        $artwork = base64_decode($request->get('artwork'));
        $review = $request->get('review');
        if ($currentUser == $user) {
            artworks::find($artwork)
                ->reviews()
                ->detach($user);
            artworks::find($artwork)
                ->reviews()
                ->attach([
                $user =>['content' => $review]
            ]);
        }
        else {
            abort(419);
        }
        return $returnedInfo;
    }

    /***
     * Funcion para obtener todas las reseñas menos la del usuario
     *
     * @param Request $request
     * @return mixed
     */
    public function getReviews(Request $request){
        $artwork = base64_decode($request->get('artwork_id'));
        $user = base64_decode($request->get('user_id'));
        if (!$this->canSeeArtwork($user, $artwork)) {
            abort(419);
        }

        $user = User::findOrFail($user);
        $artwork = artworks::findOrFail($artwork);
        $reviews = $artwork->reviews()
            ->where('reviews.user', '!=', $user->id)
            ->get();

        return $reviews;

    }

    /***
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function getMyReview(Request $request){
        $artwork = base64_decode($request->get('artwork_id'));
        $user = base64_decode($request->get('user_id'));
        if (!$this->canSeeArtwork($user, $artwork)) {
            abort(419);
        }

        $user = User::findOrFail($user);
        $artwork = artworks::findOrFail($artwork);
        $reviews = $artwork->reviews()
            ->where('reviews.user', '=', $user->id)
            ->get();

        return $reviews;

    }

    /***
     *
     * Terminan funciones de Reviews
     *
     */

    /***
     * Terminan Funciones de Info de Artworks
     */


}
