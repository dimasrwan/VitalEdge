@extends('layouts.vital')

@section('title', 'Optimalkan Biologi Anda')

@section('content')
<main class="max-w-6xl mx-auto px-6 py-24 text-center">
    <h1 style="font-family: 'Space Grotesk'" class="text-7xl font-bold leading-tight mb-8 uppercase">
        KUASAI <span class="accent-color">TUBUH ANDA.</span>
    </h1>
    <p class="text-gray-400 text-xl max-w-2xl mx-auto mb-12">
        Platform biohacking personal untuk melacak berat badan, hidrasi, dan performa puncak biologi Anda.
    </p>
    
    @auth
        <a href="/dashboard" class="bg-accent text-black px-10 py-4 rounded-xl font-bold uppercase tracking-widest shadow-lg hover:bg-cyan-300 transition">
            Buka Dashboard Saya
        </a>
    @else
        <div class="flex justify-center gap-4">
            <a href="/login" class="bg-accent text-black px-10 py-4 rounded-xl font-bold uppercase tracking-widest shadow-lg hover:bg-cyan-300 transition">
                Mulai Sekarang
            </a>
        </div>
    @endauth
</main>
@endsection