@extends('layouts.writer.base')

@section('title',"Personajes")
@section('content')
    <characters-index-component
    
                       creator="{{base64_encode(auth()->id())}}"
                       character-route="{{route('api.character.index')}}"
                       character-create-route="{{route('writer.character.create')}}"

                       token="{{csrf_token()}}"
                       
    > 
        
    </characters-index-component>
@endsection
