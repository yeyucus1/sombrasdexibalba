@extends('layouts.writer.base')

@section('title')
    Todas las obras
@endsection

@section('content')
<div class="container py-4">

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h4 class="mb-0">
                📚 Todas las obras
            </h4>
        </div>

        <div class="card-body">

            @foreach ($artworks as $artwork)
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body">

                        <h5 class="card-title mb-1">
                            {{ $artwork->title }}
                        </h5>

                        <p class="text-muted mb-2">
                            por {{ $artwork->author->pseudonym ?? 'Autor desconocido' }}
                        </p>

                        <p class="card-text">
                            {{ \Illuminate\Support\Str::limit(strip_tags($artwork->Synopsis ?? ''), 150) }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-3">

                            {{-- Estado --}}
                            @if($artwork->status == 'finished')
                                <span class="badge bg-success">
                                    Finalizada
                                </span>
                            @else
                                <span class="badge bg-warning text-dark">
                                    En proceso
                                </span>
                            @endif

                            {{-- Botón --}}
                            <a href="{{ route('writer.artworks.read', $artwork->id) }}"
                               class="btn btn-primary btn-sm">
                                Leer obra →
                            </a>

                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>

</div>
@endsection