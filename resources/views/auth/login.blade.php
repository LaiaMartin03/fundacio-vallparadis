<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}" class="w-full flex flex-col gap-10 items-center">
        @csrf

        <h1 class="text-4xl text-[#FF7400] font-medium text-center w-full">Iniciar sessió</h1>

        <div class="block mt-4 w-full">
            <!-- Email Address -->
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Correu electronic"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <!-- Password -->
            <x-text-input id="password" class="block mt-1 w-full mt-5"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Contrasenya"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <!-- Forgot password -->
            <!--<label for="remember_me" class="inline-flex items-center">
                <x-checkbox id="remember_me" name="remember"/>
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>-->
            @if (Route::has('password.request'))
                <a class="mt-2 block underline text-xs text-gray-400 dark:text-gray-300 hover:text-[#FF9740] ease-in-out duration-300 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF9740] dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Has oblidat la contrasenya?') }}
                </a>
            @endif
        </div>

            <x-primary-button class="ms-3 mt-4">
                {{ __('Entrar') }}
            </x-primary-button>
    </form>
</x-guest-layout>
