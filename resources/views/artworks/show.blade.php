<x-app-layout>
    <div class="relative z-50 mt-[500px]">
        <div class="max-w-3xl mx-auto py-10 px-6 bg-white shadow rounded">

            {{-- TÍTULO --}}
            <h1 class="text-4xl font-bold mb-2 text-gray-900">
                {{ $artwork->title }}
            </h1>

            {{-- AUTOR --}}
            <p class="text-gray-500 mb-6">
                por {{ $artwork->author->pseudonym ?? 'Autor desconocido' }}
            </p>

            {{-- CONTENIDO COMPLETO (HTML DEL EDITOR) --}}
            <div class="prose prose-lg max-w-none text-gray-900">
                {!! $artwork->content !!}
            </div>

            {{-- METADATA (opcional, pero pro) --}}
            <hr class="my-8">

            <div class="text-sm text-gray-500 space-y-1">
                <p><strong>Estado:</strong> {{ $artwork->status }}</p>
                <p><strong>Acceso:</strong> {{ $artwork->access }}</p>
                <p><strong>Publicado:</strong> {{ $artwork->public ? 'Sí' : 'No' }}</p>
                <p><strong>Creado:</strong> {{ $artwork->created_at->format('d/m/Y') }}</p>
            </div>

        </div>
    </div>
</x-app-layout>
