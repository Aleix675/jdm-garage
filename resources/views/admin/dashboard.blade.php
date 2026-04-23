@extends('layouts.app')
@section('title', 'Panel Admin')

@section('content')
<h1 class="text-2xl font-bold mb-8">Panel d'administració</h1>

{{-- STATS --}}
<div class="grid grid-cols-3 gap-4 mb-8">
    <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Cotxes totals</p>
        <p class="text-4xl font-black text-yellow-400">{{ $totalCars }}</p>
    </div>
    <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Usuaris</p>
        <p class="text-4xl font-black text-white">{{ $totalUsers }}</p>
    </div>
    <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Etiquetes</p>
        <p class="text-4xl font-black text-white">{{ $totalTags }}</p>
    </div>
</div>

<div class="grid grid-cols-2 gap-6">
    {{-- RECENT CARS --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
        <div class="flex items-center justify-between px-5 py-3 border-b border-gray-800">
            <h2 class="font-semibold text-sm">Últims cotxes</h2>
            <a href="{{ route('cars.index') }}" class="text-yellow-400 text-xs hover:underline">Veure tots</a>
        </div>
        <table class="w-full text-sm">
            <tbody>
                @foreach($recentCars as $car)
                    <tr class="border-b border-gray-800 last:border-0 hover:bg-gray-800/50 transition">
                        <td class="px-5 py-2.5">
                            <a href="{{ route('cars.show', $car) }}" class="text-white hover:text-yellow-400 transition font-medium">
                                {{ $car->brand }} {{ $car->model }}
                            </a>
                            <p class="text-gray-500 text-xs">{{ $car->user->name }}</p>
                        </td>
                        <td class="px-5 py-2.5 text-right">
                            <span class="text-yellow-400 text-xs font-mono">{{ $car->year }}</span>
                        </td>
                        <td class="px-5 py-2.5 text-right">
                            <div class="flex gap-1 justify-end">
                                <a href="{{ route('cars.edit', $car) }}" class="text-xs text-gray-400 hover:text-yellow-400 transition">Editar</a>
                                <form method="POST" action="{{ route('cars.destroy', $car) }}"
                                      onsubmit="return confirm('Eliminar?')">
                                    @csrf @method('DELETE')
                                    <button class="text-xs text-gray-400 hover:text-red-400 transition ml-2">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- USERS --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
        <div class="flex items-center justify-between px-5 py-3 border-b border-gray-800">
            <h2 class="font-semibold text-sm">Usuaris</h2>
        </div>
        <table class="w-full text-sm">
            <tbody>
                @foreach($users as $user)
                    <tr class="border-b border-gray-800 last:border-0 hover:bg-gray-800/50 transition">
                        <td class="px-5 py-2.5">
                            <p class="text-white font-medium">{{ $user->name }}</p>
                            <p class="text-gray-500 text-xs">{{ $user->email }}</p>
                        </td>
                        <td class="px-5 py-2.5 text-center">
                            @if($user->is_admin)
                                <span class="text-xs bg-yellow-400/10 text-yellow-400 px-2 py-0.5 rounded-full">Admin</span>
                            @else
                                <span class="text-xs text-gray-500">{{ $user->cars_count }} cotxes</span>
                            @endif
                        </td>
                        <td class="px-5 py-2.5 text-right">
                            @if(!$user->is_admin)
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                      onsubmit="return confirm('Eliminar usuari {{ $user->name }}?')">
                                    @csrf @method('DELETE')
                                    <button class="text-xs text-gray-400 hover:text-red-400 transition">Eliminar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
