@extends('layouts.writer.base')
@section('title')
    <h1 class="m-0">Nueva Obra</h1>
@endsection
@section('content')

    <artwork-component save-route="{{route('api.artwork.store')}}"
                       main-route="{{route('writer.artworks.index')}}"
                       :genres="{{$artworkGeneres}}"
                       :types="{{$artworkTypes}}"
                       :locations="{{$locations}}"
                       token="{{csrf_token()}}"
                       :characters="{{$characters}}"
                       :creator="{{Auth::user()->id}}"
    />

@endsection
