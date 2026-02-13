<section>
    <header>
        <h2 class="text-xl font-bold text-white tracking-tight flex items-center">
            <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-2 shadow-[0_0_8px_#f97316]"></span>
            {{ __('Security Protocol') }}
        </h2>

        <p class="mt-2 text-[10px] text-gray-500 uppercase tracking-[0.2em] font-medium">
            {{ __("Ensure your account is using a long, random password to stay secure.") }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-8">
        @csrf
        @method('put')

        <div class="group">
            <label class="block text-[10px] uppercase font-black text-gray-500 mb-2 tracking-widest group-focus-within:text-orange-500 transition-colors" for="update_password_current_password">
                {{ __('Current Key') }}
            </label>
            <input id="update_password_current_password" name="current_password" type="password" 
                class="w-full bg-black/50 border border-gray-800 p-4 rounded-xl text-white text-lg outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500/20 transition duration-300" 
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-500 text-xs italic" />
        </div>

        <div class="group">
            <label class="block text-[10px] uppercase font-black text-gray-500 mb-2 tracking-widest group-focus-within:text-orange-500 transition-colors" for="update_password_password">
                {{ __('New Encryption Key') }}
            </label>
            <input id="update_password_password" name="password" type="password" 
                class="w-full bg-black/50 border border-gray-800 p-4 rounded-xl text-white text-lg outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500/20 transition duration-300" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-500 text-xs italic" />
        </div>

        <div class="group">
            <label class="block text-[10px] uppercase font-black text-gray-500 mb-2 tracking-widest group-focus-within:text-orange-500 transition-colors" for="update_password_password_confirmation">
                {{ __('Verify New Key') }}
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                class="w-full bg-black/50 border border-gray-800 p-4 rounded-xl text-white text-lg outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500/20 transition duration-300" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-500 text-xs italic" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="px-8 py-3 bg-orange-500 text-black text-[10px] font-black uppercase tracking-[0.2em] rounded-xl hover:bg-orange-400 transition shadow-lg shadow-orange-500/10 active:scale-95">
                {{ __('Re-Encrypt Account') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-[10px] font-bold text-orange-500 uppercase tracking-widest animate-pulse"
                >{{ __('Encryption Key Updated.') }}</p>
            @endif
        </div>
    </form>
</section>