<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Surname -->
        <div class="mt-4">
            <x-input-label for="surname" :value="__('Cognom')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Birthday -->
        <div class="mt-4">
            <x-input-label for="birthday" :value="__('Data de naixement')" />
            <x-text-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" />
            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Adreça')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Telèfon')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Curriculum -->
        <div class="mt-4">
            <x-input-label for="curriculum" :value="__('Currículum')" />
            <input id="curriculum" name="curriculum" type="file" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('curriculum')" class="mt-2" />
        </div>

        <!-- Active -->
        <div class="mt-4">
            <x-input-label for="active" :value="__('Actiu')" />
            <input id="active" type="checkbox" name="active" value="1" {{ old('active') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            <x-input-error :messages="$errors->get('active')" class="mt-2" />
        </div>

        <!-- Locker -->
        <div class="mt-4">
            <x-input-label for="locker" :value="__('Taquilla')" />
            <x-text-input id="locker" class="block mt-1 w-full" type="text" name="locker" :value="old('locker')" />
            <x-input-error :messages="$errors->get('locker')" class="mt-2" />
        </div>

        <!-- Code -->
        <div class="mt-4">
            <x-input-label for="code" :value="__('Codi')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <!-- Info ID -->
        <div class="mt-4">
            <x-input-label for="info_id" :value="__('Info ID')" />
            <x-text-input id="info_id" class="block mt-1 w-full" type="number" name="info_id" :value="old('info_id')" />
            <x-input-error :messages="$errors->get('info_id')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Birthday -->
        <div class="mt-4">
            <x-input-label for="birthday" :value="__('Data de naixement')" />
            <x-text-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" />
            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-300 dark:text-gray-400 hover:text-[#FF9740] ease-in-out duration-300 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Ja tens compte?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrar-se') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
