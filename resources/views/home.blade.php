@extends('layouts.app')
@section('title', 'Inici')

@section('content')
{{-- HERO --}}
<div class="text-center py-16">
    <h1 class="text-5xl font-black tracking-tight mb-4">
        <span class="text-white">JDM</span> <span class="text-yellow-400">Garage</span>
    </h1>
    <p class="text-gray-400 text-lg mb-8">Col·leccionisme de cotxes japonesos dels anys 90–2000</p>
    @guest
        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-6 py-2.5 rounded-lg font-bold hover:bg-yellow-300 transition">Crea el teu garatge</a>
            <a href="{{ route('login') }}" class="border border-gray-600 text-gray-300 px-6 py-2.5 rounded-lg hover:border-yellow-400 hover:text-yellow-400 transition">Login</a>
        </div>
    @endguest
</div>

{{-- CARS GRID --}}
<div class="mb-6 flex items-center justify-between">
    <h2 class="text-xl font-bold text-gray-200">
        @auth Tots els cotxes @else Cotxes destacats @endauth
    </h2>
    @auth
        <a href="{{ route('cars.create') }}" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded font-semibold text-sm hover:bg-yellow-300 transition">+ Afegir cotxe</a>
    @endauth
</div>

@if($cars->isEmpty())
    <p class="text-gray-500 text-center py-20">Encara no hi ha cotxes. Sigues el primer!</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($cars as $car)
            <a href="{{ route('cars.show', $car) }}" class="group bg-gray-900 border border-gray-800 rounded-xl overflow-hidden hover:border-yellow-500/50 transition-all hover:-translate-y-0.5">
                @if($car->image_path)
                    <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->brand }} {{ $car->model }}"
                         class="w-full h-48 object-cover group-hover:brightness-110 transition">
                @else
                    <div class="w-full h-48 bg-gray-800 flex items-center justify-center text-4xl">🚗</div>
                @endif
                <div class="p-4">
                    <div class="flex items-start justify-between mb-1">
                        <h3 class="font-bold text-white">{{ $car->brand }} {{ $car->model }}</h3>
                        <span class="text-yellow-400 text-sm font-mono">{{ $car->year }}</span>
                    </div>
                    @if($car->engine)
                        <p class="text-gray-500 text-sm mb-2">{{ $car->engine }}</p>
                    @endif
                    <div class="flex flex-wrap gap-1 mt-2">
                        @foreach($car->tags as $tag)
                            <span class="text-xs px-2 py-0.5 rounded-full font-medium"
                                  style="background-color: {{ $tag->color }}22; color: {{ $tag->color }}; border: 1px solid {{ $tag->color }}44">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                    <p class="text-gray-600 text-xs mt-3">per {{ $car->user->name }}</p>
                </div>
            </a>
        @endforeach
    </div>

    @guest
        <div class="text-center mt-10 py-8 border border-dashed border-gray-700 rounded-xl">
            <p class="text-gray-400 mb-4">Registra't per veure tots els cotxes i afegir el teu</p>
            <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-6 py-2 rounded-lg font-bold hover:bg-yellow-300 transition">Crear compte</a>
        </div>
    @endguest

    @auth
        <div class="mt-8">{{ $cars->links() }}</div>
    @endauth
@endif
@endsection
