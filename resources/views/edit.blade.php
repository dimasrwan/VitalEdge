@extends('layouts.vital')

@section('title', 'Setelan Profil')

@section('content')
<main class="max-w-4xl mx-auto px-6 py-12">
    <div class="flex items-center gap-6 mb-12">
        <div class="h-20 w-20 bg-accent rounded-2xl flex items-center justify-center shadow-[0_0_20px_rgba(102,252,241,0.3)]">
            <span class="text-3xl font-black text-black uppercase">{{ substr(auth()->user()->name, 0, 1) }}</span>
        </div>
        <div>
            <h1 style="font-family: 'Space Grotesk'" class="text-4xl font-bold uppercase tracking-tight">
                IDENTITAS <span class="accent-color">SISTEM.</span>
            </h1>
            <p class="text-gray-500 text-sm tracking-widest uppercase">ID Pengguna: #{{ auth()->user()->id }}</p>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        <div class="space-y-2">
            <button class="w-full text-left px-4 py-3 rounded-xl bg-accent text-black font-bold text-xs uppercase tracking-widest">
                Informasi Dasar
            </button>
            <button class="w-full text-left px-4 py-3 rounded-xl text-gray-500 hover:text-white transition text-xs uppercase tracking-widest">
                Keamanan Akun
            </button>
            <button class="w-full text-left px-4 py-3 rounded-xl text-red-500/50 hover:text-red-500 transition text-xs uppercase tracking-widest">
                Hapus Data
            </button>
        </div>

        <div class="md:col-span-2 space-y-8">
            <div class="bg-gray-900/40 p-8 rounded-3xl border border-gray-800 backdrop-blur-sm">
                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-gray-500 mb-2 font-bold uppercase text-[10px] tracking-[0.2em]">Nama Identitas</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                                class="w-full bg-black/50 border border-gray-800 p-4 rounded-xl focus:border-cyan-500 transition text-white outline-none">
                        </div>

                        <div>
                            <label class="block text-gray-500 mb-2 font-bold uppercase text-[10px] tracking-[0.2em]">Alamat Jalur Komunikasi (Email)</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                                class="w-full bg-black/50 border border-gray-800 p-4 rounded-xl focus:border-cyan-500 transition text-white outline-none">
                        </div>

                        <div>
                            <label class="block text-cyan-500 mb-2 font-bold uppercase text-[10px] tracking-[0.2em]">Parameter Tinggi (CM)</label>
                            <input type="number" step="0.1" name="height" value="{{ old('height', $user->height) }}" required 
                                class="w-full bg-black/50 border border-cyan-900/30 p-4 rounded-xl focus:border-cyan-500 transition text-white text-xl outline-none shadow-inner">
                            <p class="text-gray-600 text-[10px] mt-3 italic tracking-wide">Data ini digunakan sebagai konstanta perhitungan BMI di dashboard Lab Anda.</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-800/50">
                        <button type="submit" class="bg-accent text-black px-10 py-4 rounded-xl font-black uppercase text-xs tracking-[0.2em] hover:scale-105 transition active:scale-95 shadow-lg shadow-cyan-500/10">
                            Simpan Konfigurasi
                        </button>

                        @if (session('status') === 'profile-updated')
                            <div class="flex items-center gap-2 text-green-400 text-xs font-bold uppercase tracking-widest animate-bounce">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                Berhasil Disinkronkan
                            </div>
                        @endif
                    </div>
                </form>
            </div>

            <div class="p-8 rounded-3xl border border-red-900/20 bg-red-900/5 flex justify-between items-center">
                <div>
                    <h4 class="text-red-500 font-bold text-xs uppercase tracking-widest">Hapus Semua Data</h4>
                    <p class="text-gray-600 text-[10px]">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <button class="text-red-500 hover:bg-red-500 hover:text-white border border-red-500/30 px-4 py-2 rounded-lg text-[10px] font-bold uppercase transition">Erase System</button>
            </div>
        </div>
    </div>
</main>
@endsection