@extends('layouts.vital')

@section('title', 'Otentikasi Sistem')

@section('content')
<main class="min-h-[80-vh] flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gray-900 border border-cyan-500/30 mb-4 shadow-[0_0_20px_rgba(102,252,241,0.1)]">
                <svg class="w-8 h-8 accent-color" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A10.003 10.003 0 0012 3c1.268 0 2.39.234 3.468.657m-3.469 7.343l.053-.09A10.003 10.003 0 0121 11c0 2.73-.868 5.357-2.43 7.561m-4.57-4.56l-.053.09A10.003 10.003 0 0012 21c-1.268 0-2.39-.234-3.468-.657m3.469-7.343l-.053.09a10.003 10.003 0 01-3.468-6.657"></path>
                </svg>
            </div>
            <h1 style="font-family: 'Space Grotesk'" class="text-3xl font-bold uppercase tracking-tighter italic">
                Akses <span class="accent-color">Terminal.</span>
            </h1>
            <p class="text-gray-500 text-xs uppercase tracking-[0.3em] mt-2">Masukkan kredensial biometrik Anda</p>
        </div>

        <div class="bg-gray-900/40 backdrop-blur-md p-8 rounded-3xl border border-gray-800 shadow-2xl">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                        class="w-full bg-black/50 border border-gray-700 p-4 rounded-xl text-white outline-none focus:border-cyan-500 transition-all duration-300 shadow-inner"
                        placeholder="nama@email.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-400" />
                </div>

                <div>
                    <div class="flex justify-between mb-2 ml-1">
                        <label for="password" class="text-[10px] font-black uppercase tracking-widest text-gray-400">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[10px] text-cyan-600 hover:text-cyan-400 uppercase font-bold transition">Lupa?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required 
                        class="w-full bg-black/50 border border-gray-700 p-4 rounded-xl text-white outline-none focus:border-cyan-500 transition-all duration-300 shadow-inner"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-400" />
                </div>

                <div class="flex items-center ml-1">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-700 bg-black text-cyan-500 focus:ring-cyan-500/20">
                    <span class="ml-2 text-[10px] text-gray-500 uppercase font-bold tracking-widest cursor-pointer">Ingat Saya</span>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-accent text-black py-4 rounded-xl font-black uppercase tracking-widest hover:bg-cyan-300 hover:scale-[1.02] active:scale-95 transition-all duration-300 shadow-lg shadow-cyan-500/10">
                        Masuk
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center mt-8 text-gray-500 text-xs font-bold uppercase tracking-widest">
            Belum memiliki akun? 
            <a href="{{ route('register') }}" class="accent-color hover:underline">Daftar</a>
        </p>
    </div>
</main>
@endsection