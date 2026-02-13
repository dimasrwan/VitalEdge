@extends('layouts.vital')
@section('title', 'Setelan Profil')

@section('content')
<main class="max-w-4xl mx-auto px-6 py-12">
    <div class="flex items-center gap-6 mb-12">
        <div class="h-20 w-20 bg-accent rounded-2xl flex items-center justify-center shadow-[0_0_20px_rgba(102,252,241,0.3)]">
            <span class="text-3xl font-black text-black uppercase">{{ substr(auth()->user()->name, 0, 1) }}</span>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-white tracking-tight">Identity Terminal</h2>
            <p class="text-cyan-500 text-[10px] uppercase font-bold tracking-[0.3em]">User Authentication & Records</p>
        </div>
    </div>

    <div class="space-y-12">
        <div class="bg-gray-900/40 p-8 rounded-3xl border border-gray-800 backdrop-blur-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-5">
                <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
            </div>
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-gray-900/40 p-8 rounded-3xl border border-gray-800 backdrop-blur-sm">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-red-900/10 p-8 rounded-3xl border border-red-900/30">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</main>
@endsection