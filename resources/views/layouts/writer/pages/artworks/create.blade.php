@extends('layouts.writer.base')
@section('title')
    <h1 class="m-0">Nueva Obra</h1>
@endsection
@section('content')

    <artwork-component :user="{{$author}}"
                       save-route="{{route('api.artwork.store')}}"
                       :genres="{{$artworkGeneres}}"
                       :types="{{$artworkTypes}}"
                       :locations="{{$locations}}"
                       token="{{csrf_token()}}"
                       :characters="{{$characters}}"
    />

@endsection
