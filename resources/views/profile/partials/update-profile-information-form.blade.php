<section>
    <header>
        <h2 class="text-xl font-bold text-white tracking-tight flex items-center">
            <span class="w-1.5 h-1.5 bg-cyan-500 rounded-full mr-2 shadow-[0_0_8px_#66fcf1]"></span>
            {{ __('Account Data') }}
        </h2>

        <p class="mt-2 text-[10px] text-gray-500 uppercase tracking-[0.2em] font-medium">
            {{ __("Modify your terminal authentication and contact address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-8">
        @csrf
        @method('patch')

        <div class="group">
            <label class="block text-[10px] uppercase font-black text-gray-500 mb-2 tracking-widest group-focus-within:text-cyan-500 transition-colors" for="name">
                {{ __('Full Identity Name') }}
            </label>
            <input id="name" name="name" type="text" 
                class="w-full bg-black/50 border border-gray-800 p-4 rounded-xl text-white text-lg outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/20 transition duration-300" 
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-500 text-xs italic" :messages="$errors->get('name')" />
        </div>

        <div class="group">
            <label class="block text-[10px] uppercase font-black text-gray-500 mb-2 tracking-widest group-focus-within:text-cyan-500 transition-colors" for="email">
                {{ __('Secure Contact Address') }}
            </label>
            <input id="email" name="email" type="email" 
                class="w-full bg-black/50 border border-gray-800 p-4 rounded-xl text-white text-lg outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/20 transition duration-300" 
                value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-500 text-xs italic" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-3 bg-yellow-500/10 border border-yellow-500/20 rounded-lg">
                    <p class="text-xs text-yellow-500">
                        {{ __('Identity verification required.') }}

                        <button form="send-verification" class="ml-2 font-black uppercase tracking-tighter hover:text-white transition">
                            {{ __('Resend Protocol') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-[10px] text-green-500 uppercase tracking-widest">
                            {{ __('Verification protocol transmitted to inbox.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="px-8 py-3 bg-accent text-black text-[10px] font-black uppercase tracking-[0.2em] rounded-xl hover:bg-cyan-300 transition shadow-lg shadow-cyan-500/10 active:scale-95">
                {{ __('Update Identity') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest animate-pulse"
                >{{ __('Protocol Synchronized.') }}</p>
            @endif
        </div>
    </form>
</section>