@extends('layouts.writer.base')

@section('title')
    <h1 class="m-0"></h1>
@endsection

@section('content')

<div id="app">

    
    <artworks-component-read
        :artwork='@json($selectedArtwork)'
        :current-user='@json($user)'
        token="{{ csrf_token() }}"
        info-route="{{ str_replace('/author', '', route('api.artworks.info.author')) }}"
    />
    

</div>

@endsection
