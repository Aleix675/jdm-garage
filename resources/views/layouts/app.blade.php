<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JDM Garage – @yield('title', 'Inici')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    <nav class="bg-gray-900 border-b border-yellow-500/30 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16">
            <a href="/" class="text-xl font-bold tracking-tight">
                <span class="text-white">JDM</span><span class="text-yellow-400"> Garage</span>
            </a>
            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('cars.index') }}" class="text-gray-300 hover:text-yellow-400 transition">Cotxes</a>

                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-yellow-400 transition">Admin</a>
                        <a href="{{ route('tags.index') }}" class="text-gray-300 hover:text-yellow-400 transition">Tags</a>
                    @endif
                    <a href="{{ route('cars.create') }}" class="bg-yellow-400 text-gray-900 px-3 py-1.5 rounded font-semibold hover:bg-yellow-300 transition">+ Cotxe</a>
                    <span class="text-gray-400">{{ auth()->user()->name }}</span>
                    <a href="{{ route('profile.edit') }}" class="text-gray-300 hover:text-yellow-400 transition">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-400 transition">Sortir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-yellow-400 transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-3 py-1.5 rounded font-semibold hover:bg-yellow-300 transition">Registre</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 text-sm px-4 py-3 text-center">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/30 text-red-400 text-sm px-4 py-3 text-center">
            {{ session('error') }}
        </div>
    @endif

    {{-- CONTENT --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-gray-900 border-t border-gray-800 text-center text-gray-500 text-xs py-4">
        JDM Garage · Col·leccionisme de cotxes japonesos dels anys 90–2000
    </footer>
</body>
</html>
