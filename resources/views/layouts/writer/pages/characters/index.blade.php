@extends('layouts.writer.base')
@section('title',"Personajes")
@section('content')
    <characters-index-component
    
                       creator="{{base64_encode(auth()->id())}}"
                       character-route="{{route('api.character.index')}}"
                       token="{{csrf_token()}}"
                       
    > 
        
    </characters-index-component>
@endsection
