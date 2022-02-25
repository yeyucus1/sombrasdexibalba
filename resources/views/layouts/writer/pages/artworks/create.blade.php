@extends('layouts.writer.base')
@section('title')
    <h1 class="m-0">Nueva Obra</h1>
@endsection
@section('content')

    <artwork-component :user="{{$author}}" :genres="{{$artworkGeneres}}" :types="{{$artworkTypes}}"/>

@endsection
