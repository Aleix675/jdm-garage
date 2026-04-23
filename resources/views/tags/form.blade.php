@extends('layouts.app')
@section('title', isset($tag) ? 'Editar etiqueta' : 'Nova etiqueta')

@section('content')
<div class="max-w-md mx-auto">
    <a href="{{ route('tags.index') }}" class="text-gray-400 hover:text-yellow-400 text-sm mb-6 inline-flex items-center gap-1 transition">
        ← Tornar
    </a>

    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mt-4">
        <h1 class="text-xl font-bold mb-6">{{ isset($tag) ? 'Editar etiqueta' : 'Nova etiqueta' }}</h1>

        <form method="POST"
              action="{{ isset($tag) ? route('tags.update', $tag) : route('tags.store') }}"
              class="space-y-4">
            @csrf
            @isset($tag) @method('PUT') @endisset

            <div>
                <label class="block text-sm text-gray-400 mb-1">Nom <span class="text-red-400">*</span></label>
                <input type="text" name="name" value="{{ old('name', $tag->name ?? '') }}"
                       class="w-full bg-gray-800 border @error('name') border-red-500 @else border-gray-700 @enderror text-white rounded-lg px-3 py-2 focus:outline-none focus:border-yellow-400"
                       placeholder="ex: turbo, drift, stance...">
                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-400 mb-1">Color</label>
                <div class="flex items-center gap-3">
                    <input type="color" name="color" value="{{ old('color', $tag->color ?? '#3B82F6') }}"
                           class="w-12 h-10 bg-gray-800 border border-gray-700 rounded-lg cursor-pointer">
                    <span class="text-gray-400 text-sm">Tria el color de l'etiqueta</span>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="bg-yellow-400 text-gray-900 px-6 py-2.5 rounded-lg font-bold hover:bg-yellow-300 transition">
                    {{ isset($tag) ? 'Guardar' : 'Crear etiqueta' }}
                </button>
                <a href="{{ route('tags.index') }}"
                   class="border border-gray-600 text-gray-400 px-6 py-2.5 rounded-lg hover:border-gray-400 transition">
                    Cancel·lar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
