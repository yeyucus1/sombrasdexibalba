@extends('layouts.writer.base')
 @section('title')
    <div class="max-w-5xl mx-auto py-10">

        <h1 class="text-3xl font-bold mb-6">
            📚 Todas las obras
        </h1>
@endsection @section('content')
        @foreach ($artworks as $artwork)
            <div class="bg-white shadow rounded p-5 mb-4">

                <h2 class="text-xl font-semibold">
                    {{ $artwork->title }}
                </h2>

                
                <p class="text-sm text-gray-500">
                    por {{ $artwork->author->pseudonym ?? 'Autor desconocido' }}
                </p>

                <p class="mt-3 text-gray-700">
                    {{ \Illuminate\Support\Str::limit($artwork->synopsis, 150) }}
                </p>
                
                <a
                    href="{{ route('writer.artworks.read', $artwork->id) }}"
                    class="inline-block mt-3 text-indigo-600 hover:underline"
                >
                    Leer obra →
                </a>
                
            </div>
        @endforeach

    </div>
@endsection @section('content') 
