
@extends('layouts.writer.base')
@section('title',"Personajes")

@section('content')

    <characters-create-component
     character-store-route="{{route('api.character.store')}}"
     
                   
                       
    >
    </characters-create-component

@endsection