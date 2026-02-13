@extends('layouts.vital')

@section('content')
<main class="min-h-[90vh] flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-lg">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gray-900 border border-cyan-500/30 mb-4 shadow-[0_0_20px_rgba(102,252,241,0.1)]">
                <svg class="w-8 h-8 accent-color" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h1 style="font-family: 'Space Grotesk'" class="text-3xl font-bold uppercase tracking-tighter italic">
                Registrasi <span class="accent-color">Subjek.</span>
            </h1>
            <p class="text-gray-500 text-xs uppercase tracking-[0.3em] mt-2">Inisialisasi Profil Biometrik Baru</p>
        </div>

        <div class="bg-gray-900/40 backdrop-blur-md p-8 rounded-3xl border border-gray-800 shadow-2xl">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Nama</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus 
                            class="w-full bg-black/50 border border-gray-700 p-4 rounded-xl text-white outline-none focus:border-cyan-500 transition-all shadow-inner"
                            placeholder="Contoh: Dimas">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-400" />
                    </div>

                    <div class="md:col-span-2">
                        <label for="email" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required 
                            class="w-full bg-black/50 border border-gray-700 p-4 rounded-xl text-white outline-none focus:border-cyan-500 transition-all shadow-inner"
                            placeholder="nama@email.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-400" />
                    </div>

                    <div>
                        <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Password</label>
                        <input id="password" type="password" name="password" required 
                            class="w-full bg-black/50 border border-gray-700 p-4 rounded-xl text-white outline-none focus:border-cyan-500 transition-all shadow-inner"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-400" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">New Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required 
                            class="w-full bg-black/50 border border-gray-700 p-4 rounded-xl text-white outline-none focus:border-cyan-500 transition-all shadow-inner"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-400" />
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-800/50 mt-6">
                    <button type="submit" class="w-full bg-accent text-black py-4 rounded-xl font-black uppercase tracking-widest hover:bg-cyan-300 hover:scale-[1.02] active:scale-95 transition-all duration-300 shadow-lg shadow-cyan-500/10">
                        Buat Profil Baru
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center mt-8 text-gray-500 text-xs font-bold uppercase tracking-widest">
            Sudah memiliki akun? 
            <a href="{{ route('login') }}" class="accent-color hover:underline">Masuk</a>
        </p>
    </div>
</main>
@endsection