@extends('layouts.app')
@section('title', $car->brand . ' ' . $car->model)

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- BACK --}}
    <a href="{{ route('cars.index') }}" class="text-gray-400 hover:text-yellow-400 text-sm mb-6 inline-flex items-center gap-1 transition">
        ← Tornar al llistat
    </a>

    <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden mt-4">
        {{-- IMAGE --}}
        @if($car->image_path)
            <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->brand }} {{ $car->model }}"
                 class="w-full h-80 object-cover">
        @else
            <div class="w-full h-64 bg-gray-800 flex items-center justify-center text-6xl">🚗</div>
        @endif

        <div class="p-6">
            {{-- HEADER --}}
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h1 class="text-3xl font-black text-white">{{ $car->brand }} {{ $car->model }}</h1>
                    <p class="text-yellow-400 text-lg font-mono mt-1">{{ $car->year }}</p>
                </div>
                @can('update', $car)
                    <div class="flex gap-2">
                        <a href="{{ route('cars.edit', $car) }}"
                           class="border border-gray-600 text-gray-300 px-4 py-2 rounded-lg text-sm hover:border-yellow-400 hover:text-yellow-400 transition">
                            Editar
                        </a>
                        <form method="POST" action="{{ route('cars.destroy', $car) }}"
                              onsubmit="return confirm('Eliminar aquest cotxe?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="border border-red-800 text-red-400 px-4 py-2 rounded-lg text-sm hover:bg-red-900/30 transition">
                                Eliminar
                            </button>
                        </form>
                    </div>
                @endcan
            </div>

            {{-- SPECS --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-6">
                @if($car->engine)
                    <div class="bg-gray-800 rounded-lg p-3">
                        <p class="text-xs text-gray-500 mb-1">Motor</p>
                        <p class="text-white font-medium">{{ $car->engine }}</p>
                    </div>
                @endif
                @if($car->color)
                    <div class="bg-gray-800 rounded-lg p-3">
                        <p class="text-xs text-gray-500 mb-1">Color</p>
                        <p class="text-white font-medium">{{ $car->color }}</p>
                    </div>
                @endif
                <div class="bg-gray-800 rounded-lg p-3">
                    <p class="text-xs text-gray-500 mb-1">Propietari</p>
                    <p class="text-white font-medium">{{ $car->user->name }}</p>
                </div>
            </div>

            {{-- DESCRIPTION --}}
            @if($car->description)
                <div class="mb-6">
                    <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wide mb-2">Descripció</h2>
                    <p class="text-gray-300 leading-relaxed">{{ $car->description }}</p>
                </div>
            @endif

            {{-- TAGS --}}
            @if($car->tags->count())
                <div>
                    <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wide mb-2">Etiquetes</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($car->tags as $tag)
                            <span class="px-3 py-1 rounded-full text-sm font-medium"
                                  style="background-color: {{ $tag->color }}22; color: {{ $tag->color }}; border: 1px solid {{ $tag->color }}55">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
