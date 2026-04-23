@extends('layouts.app')
@section('title', 'Etiquetes')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Etiquetes</h1>
    <a href="{{ route('tags.create') }}" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg font-bold hover:bg-yellow-300 transition">+ Nova etiqueta</a>
</div>

<div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-800 text-gray-400 text-xs uppercase tracking-wide">
                <th class="text-left px-5 py-3">Etiqueta</th>
                <th class="text-left px-5 py-3">Color</th>
                <th class="text-left px-5 py-3">Cotxes</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($tags as $tag)
                <tr class="border-b border-gray-800 hover:bg-gray-800/50 transition">
                    <td class="px-5 py-3">
                        <span class="px-3 py-1 rounded-full text-sm font-medium"
                              style="background-color: {{ $tag->color }}22; color: {{ $tag->color }}; border: 1px solid {{ $tag->color }}44">
                            {{ $tag->name }}
                        </span>
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 rounded-full border border-gray-600" style="background-color: {{ $tag->color }}"></div>
                            <span class="text-gray-400 font-mono text-xs">{{ $tag->color }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3 text-gray-400">{{ $tag->cars_count }}</td>
                    <td class="px-5 py-3">
                        <div class="flex gap-2 justify-end">
                            <a href="{{ route('tags.edit', $tag) }}"
                               class="text-xs border border-gray-700 text-gray-400 px-3 py-1 rounded hover:border-yellow-400 hover:text-yellow-400 transition">
                                Editar
                            </a>
                            <form method="POST" action="{{ route('tags.destroy', $tag) }}"
                                  onsubmit="return confirm('Eliminar l\'etiqueta {{ $tag->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="text-xs border border-gray-700 text-gray-400 px-3 py-1 rounded hover:border-red-500 hover:text-red-400 transition">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-gray-500 py-12">No hi ha etiquetes.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
