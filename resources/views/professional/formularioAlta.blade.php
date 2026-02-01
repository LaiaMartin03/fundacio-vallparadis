<x-app-layout>
    <h3>
        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @elseif ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </h3>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white rounded-xl">
        <h1 class="text-2xl font-bold mb-4">Nou Professional</h1>

        <form action="{{ route('professional.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <x-text-input id="name" name="name" type="text" placeholder="Nom" class="mt-1 block w-full" :value="old('name')" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            <!-- Surname -->
            <x-text-input id="surname" name="surname" type="text" placeholder="Cognom" class="mt-1 block w-full" :value="old('surname')" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />

            <!-- Birthday -->
            <x-text-input id="birthday" name="birthday" type="date" placeholder="Data de naixement" class="mt-1 block w-full" :value="old('birthday')" />
            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />

            <!-- Address -->
            <x-text-input id="address" name="address" type="text" placeholder="Adreça" class="mt-1 block w-full" :value="old('address')" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />

            <!-- Phone -->
            <x-text-input id="phone" name="phone" type="text" placeholder="Telèfon" class="mt-1 block w-full" :value="old('phone')" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />

            <!-- Email -->
            <x-text-input id="email" name="email" type="email" placeholder="Correu electrònic" class="mt-1 block w-full" :value="old('email')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <!-- Password -->
            <x-text-input id="password" name="password" type="password" placeholder="Contrasenya" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <!-- Password Confirmation -->
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirma la contrasenya" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

            <!-- Locker -->
            <x-text-input id="locker" name="locker" type="text" placeholder="Número de taquilla" class="mt-1 block w-full" :value="old('locker')" />
            <x-input-error :messages="$errors->get('locker')" class="mt-2" />

            <!-- Code -->
            <x-text-input id="code" name="code" type="text" placeholder="Codi de taquilla" class="mt-1 block w-full" :value="old('code')" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />

            <!-- Profile Photo -->
            <div class="mt-4">
                <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-2">
                    Foto de perfil (opcional)
                </label>
                <input type="file" id="profile_photo" name="profile_photo" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary_color focus:border-transparent"
                    accept="image/jpeg,image/jpg,image/png">
                <p class="text-sm text-gray-500 mt-1">Màxim 5MB. Formats: JPG, JPEG, PNG</p>
                <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
            </div>

            <!-- CV File -->
            <div class="mt-4">
                <label for="cv_file" class="block text-sm font-medium text-gray-700 mb-2">
                    Curriculum Vitae (opcional)
                </label>
                <input type="file" id="cv_file" name="cv_file" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary_color focus:border-transparent"
                    accept=".pdf,.doc,.docx,.txt">
                <p class="text-sm text-gray-500 mt-1">Màxim 10MB. Formats: PDF, DOC, DOCX, TXT</p>
                <x-input-error :messages="$errors->get('cv_file')" class="mt-2" />
            </div>

            <!-- Professional Type -->
            <div class="flex items-center gap-6 mt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="type" value="external" class="accent-blue-600 focus:ring-primary_color"
                        {{ old('type') == 'external' ? 'checked' : '' }}>
                    <span>Extern</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="type" value="internal" class="accent-blue-600 focus:ring-primary_color"
                        {{ old('type') == 'internal' ? 'checked' : '' }}>
                    <span>Intern</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('type')" class="mt-2" />

            <!-- Observations -->
            <x-text-input id="observations" name="observations" type="text" placeholder="Observacions" class="mt-1 block w-full" :value="old('observations')" />
            <x-input-error :messages="$errors->get('observations')" class="mt-2" />

            <!-- Active -->
            <div class="flex items-center gap-6 mt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        name="active"
                        value="1"
                        class="accent-blue-600 focus:ring-primary_color"
                        {{ old('active', '1') == "1" ? 'checked' : '' }}
                    >
                    <span>Actiu</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        name="active"
                        value="0"
                        class="accent-blue-600 focus:ring-primary_color"
                        {{ old('active') == "0" ? 'checked' : '' }}
                    >
                    <span>Inactiu</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('active')" class="mt-2" />

            <div class="flex justify-end mt-4">
                <x-primary-button>
                    Crear
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>