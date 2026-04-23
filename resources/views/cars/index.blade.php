@extends('layouts.app')
@section('title', 'Cotxes')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Tots els cotxes</h1>
    @auth
        <a href="{{ route('cars.create') }}" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg font-bold hover:bg-yellow-300 transition">+ Nou cotxe</a>
    @endauth
</div>

{{-- FILTERS --}}
<form method="GET" action="{{ route('cars.index') }}" class="bg-gray-900 border border-gray-800 rounded-xl p-4 mb-6 flex flex-wrap gap-3 items-end">
    <div>
        <label class="block text-xs text-gray-400 mb-1">Marca</label>
        <input type="text" name="brand" value="{{ request('brand') }}"
               class="bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-yellow-400"
               placeholder="ex: Toyota">
    </div>
    <div>
        <label class="block text-xs text-gray-400 mb-1">Any</label>
        <input type="number" name="year" value="{{ request('year') }}" min="1990" max="2005"
               class="bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2 text-sm w-24 focus:outline-none focus:border-yellow-400"
               placeholder="1995">
    </div>
    <div>
        <label class="block text-xs text-gray-400 mb-1">Etiqueta</label>
        <select name="tag" class="bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-yellow-400">
            <option value="">Totes</option>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg font-semibold text-sm hover:bg-yellow-300 transition">Filtrar</button>
    @if(request()->hasAny(['brand','year','tag']))
        <a href="{{ route('cars.index') }}" class="text-gray-400 hover:text-white text-sm py-2">Netejar</a>
    @endif
</form>

{{-- GRID --}}
@if($cars->isEmpty())
    <p class="text-gray-500 text-center py-20">No s'han trobat cotxes amb aquests filtres.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @foreach($cars as $car)
            <a href="{{ route('cars.show', $car) }}" class="group bg-gray-900 border border-gray-800 rounded-xl overflow-hidden hover:border-yellow-500/50 transition-all hover:-translate-y-0.5">
                @if($car->image_path)
                    <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->brand }} {{ $car->model }}"
                         class="w-full h-44 object-cover group-hover:brightness-110 transition">
                @else
                    <div class="w-full h-44 bg-gray-800 flex items-center justify-center text-3xl">🚗</div>
                @endif
                <div class="p-3">
                    <div class="flex items-start justify-between">
                        <h3 class="font-bold text-white text-sm">{{ $car->brand }} {{ $car->model }}</h3>
                        <span class="text-yellow-400 text-xs font-mono">{{ $car->year }}</span>
                    </div>
                    @if($car->engine)
                        <p class="text-gray-500 text-xs mt-0.5">{{ $car->engine }}</p>
                    @endif
                    <div class="flex flex-wrap gap-1 mt-2">
                        @foreach($car->tags as $tag)
                            <span class="text-xs px-1.5 py-0.5 rounded-full"
                                  style="background-color: {{ $tag->color }}22; color: {{ $tag->color }}">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                    <p class="text-gray-600 text-xs mt-2">{{ $car->user->name }}</p>
                </div>
            </a>
        @endforeach
    </div>
    <div class="mt-8">{{ $cars->links() }}</div>
@endif
@endsection
