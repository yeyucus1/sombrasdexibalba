@extends('layouts.writer.base')
@section('title')
    <h1 class="m-0">Mis obras</h1>
@endsection
@section('content')
    <show-artworks-component create-route="{{route('writer.artworks.create')}}"
                             artworks-route="{{route('api.artwork.mine')}}"
                             edit-route="{{route('writer.artworks.edit', 'id')}}"
                             show-route="{{route('writer.artworks.read', 'id')}}"
    />
@endsection
