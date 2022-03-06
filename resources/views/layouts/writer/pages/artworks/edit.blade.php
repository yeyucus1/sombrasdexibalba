@extends('layouts.writer.base')
@section('title')
    <h1 class="m-0">Nueva Obra</h1>
@endsection
@section('content')

    <artwork-component :info="{{$artwork}}"
                       main-route="{{route('writer.artworks.index')}}"
                       save-route="{{route('api.artwork.update', $artwork->id)}}"
                       :genres="{{$artworkGeneres}}"
                       :types="{{$artworkTypes}}"
                       :locations="{{$locations}}"
                       token="{{csrf_token()}}"
                       :characters="{{$characters}}"
    />

@endsection
