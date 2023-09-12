@extends('layouts.writer.base')
@section('title')
    <h1 class="m-0">Ver Obra</h1>
@endsection
@section('content')

    <artworks-component-read :artwork="{{$selectedArtwork}}"
                             :current-user="{{$user}}"
                             token="{{csrf_token()}}"
                             info-route="{{str_replace('/author', '', route('api.artworks.info.author'))}}"

    />

@endsection
<script>
</script>
