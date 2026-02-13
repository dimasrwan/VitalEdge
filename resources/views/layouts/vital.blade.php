<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalEdge</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0b0c10; color: #ffffff; }
        .accent-color { color: #66fcf1; }
        .bg-accent { background-color: #66fcf1; }
        .neon-border { border: 1px solid #66fcf1; box-shadow: 0 0 15px rgba(102, 252, 241, 0.2); }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>
<body>
    <nav class="p-6 flex justify-between items-center max-w-6xl mx-auto">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" class="h-10 w-10">
            <a href="/" class="text-2xl font-bold accent-color uppercase font-['Space_Grotesk'] italic">Vital<span class="text-white">Edge</span></a>
        </div>
        <div class="flex items-center gap-6 text-xs font-bold uppercase tracking-widest">
            @auth
                <a href="/dashboard" class="hover:text-cyan-400">Dashboard</a>
                <a href="/profile" class="hover:text-cyan-400">Profil</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500">Keluar</button>
                </form>
            @else
                <a href="/login" class="hover:text-cyan-400">Masuk</a>
                <a href="/register" class="bg-accent text-black px-6 py-2 rounded-full">Daftar</a>
            @endauth
        </div>
    </nav>

    @yield('content')

    @stack('scripts')
</body>
</html>