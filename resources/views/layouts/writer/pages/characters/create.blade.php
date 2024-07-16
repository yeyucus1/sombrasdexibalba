
@extends('layouts.writer.base')
@section('title',"Personajes")
<h1 class="m-0">Nuevo personaje</h1>
@section('content')

    <characters-create-component
     character-store-route="{{route('api.character.store')}}"
     
                   
                       
    >
    </characters-create-component

@endsection