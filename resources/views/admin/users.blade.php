@extends('layouts.app')
@section('title', 'Usuaris')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Gestió d'usuaris</h1>
    <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-yellow-400 text-sm transition">← Dashboard</a>
</div>

<div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-800 text-gray-400 text-xs uppercase tracking-wide">
                <th class="text-left px-5 py-3">Usuari</th>
                <th class="text-left px-5 py-3">Email</th>
                <th class="text-center px-5 py-3">Cotxes</th>
                <th class="text-center px-5 py-3">Rol</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr class="border-b border-gray-800 last:border-0 hover:bg-gray-800/50 transition">
                    <td class="px-5 py-3 font-medium text-white">{{ $user->name }}</td>
                    <td class="px-5 py-3 text-gray-400">{{ $user->email }}</td>
                    <td class="px-5 py-3 text-center text-gray-400">{{ $user->cars_count }}</td>
                    <td class="px-5 py-3 text-center">
                        @if($user->is_admin)
                            <span class="text-xs bg-yellow-400/10 text-yellow-400 px-2 py-0.5 rounded-full">Admin</span>
                        @else
                            <span class="text-xs bg-gray-700 text-gray-300 px-2 py-0.5 rounded-full">Usuari</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-right">
                        @if(!$user->is_admin)
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                  onsubmit="return confirm('Eliminar usuari {{ $user->name }}?')">
                                @csrf @method('DELETE')
                                <button class="text-xs border border-gray-700 text-gray-400 px-3 py-1 rounded hover:border-red-500 hover:text-red-400 transition">
                                    Eliminar
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-gray-500 py-12">No hi ha usuaris.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-5 py-3">{{ $users->links() }}</div>
</div>
@endsection
