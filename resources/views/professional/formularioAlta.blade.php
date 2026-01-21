<x-app-layout>
    {{-- Mensajes de éxito o errores --}}
    @if (session('success'))
        <div class="text-green-600 mb-4">
            {{ session('success') }}
        </div>
    @elseif ($errors->any())
        <div class="text-red-600 mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white rounded-xl">
        <h1 class="text-2xl font-bold mb-4">Nou Professional</h1>

        <form action="{{ route('professional.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

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

            <x-text-input id="name" name="name" type="text" placeholder="Nom" class="mt-1 block w-full" :value="old('name')" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            <x-text-input id="email" name="email" type="email" placeholder="Correu electrònic" class="mt-1 block w-full" :value="old('email')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <x-text-input id="password" name="password" type="password" placeholder="Contrasenya" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <x-text-input id="locker" name="locker" type="text" placeholder="Número de taquilla" class="mt-1 block w-full" :value="old('locker')" />
            <x-input-error :messages="$errors->get('locker')" class="mt-2" />

            <x-text-input id="code" name="code" type="text" placeholder="Codi de taquilla" class="mt-1 block w-full" :value="old('code')" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />

                
                <div class="flex items-center gap-6 mt-1">
                    
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="active" value="0" class="accent-blue-600 focus:ring-primary_color"

                        {{ old('active', '1') === "1" ? 'checked' : '' }}>
                        <span>Actiu</span>
                    </label>
                    
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="active" value="0" class="accent-blue-600 focus:ring-primary_color"

                        {{ old('active') === "0" ? 'checked' : '' }}>
                        <span>Inactiu</span>
                    </label>
                </div>

            <x-input-error :messages="$errors->get('active')" class="mt-2" />

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

            <div class="flex justify-end mt-4">
                <x-primary-button>
                    Aceptar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
