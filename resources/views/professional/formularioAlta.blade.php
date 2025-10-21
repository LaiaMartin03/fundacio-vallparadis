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

    <h1 class="text-2xl font-bold mb-4">Alta Professionals Increíblemente Increíble</h1>

    <form action="{{ route('professional.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Nombre --}}
        <x-input-label for="name" :value="'Nombre'" />
        <x-text-input id="name" name="name" type="text" placeholder="Nombre del Profesional" class="mt-1 block w-full" :value="old('name')" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />

        {{-- Email --}}
        <x-input-label for="email" :value="'Email'" />
        <x-text-input id="email" name="email" type="email" placeholder="correo@ejemplo.com" class="mt-1 block w-full" :value="old('email')" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />

        {{-- Contraseña --}}
        <x-input-label for="password" :value="'Contraseña'" />
        <x-text-input id="password" name="password" type="password" placeholder="********" class="mt-1 block w-full" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />

        {{-- Locker --}}
        <x-input-label for="locker" :value="'Locker'" />
        <x-text-input id="locker" name="locker" type="text" placeholder="Locker del profesional" class="mt-1 block w-full" :value="old('locker')" />
        <x-input-error :messages="$errors->get('locker')" class="mt-2" />

        {{-- Código --}}
        <x-input-label for="code" :value="'Código'" />
        <x-text-input id="code" name="code" type="text" placeholder="Código del profesional" class="mt-1 block w-full" :value="old('code')" />
        <x-input-error :messages="$errors->get('code')" class="mt-2" />

        {{-- Info ID --}}
        <x-input-label for="info_id" :value="'Info ID (opcional)'" />
        <x-text-input id="info_id" name="info_id" type="text" placeholder="ID de info (opcional)" class="mt-1 block w-full" :value="old('info_id')" />
        <x-input-error :messages="$errors->get('info_id')" class="mt-2" />

        {{-- Activo --}}
        <x-input-label for="active" :value="'Activo'" />

        <div class="flex items-center gap-6 mt-1">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="active" value="1" class="text-blue-600 focus:ring-blue-500"
                    {{ old('active', '1') === "1" ? 'checked' : '' }}>
                <span>Sí</span>
            </label>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="active" value="0" class="text-blue-600 focus:ring-blue-500"
                    {{ old('active') === "0" ? 'checked' : '' }}>
                <span>No</span>
            </label>
        </div>

        <x-input-error :messages="$errors->get('active')" class="mt-2" />

        {{-- Botón --}}
        <div class="flex justify-end mt-4">
            <x-primary-button>
                Aceptar
            </x-primary-button>
        </div>
    </form>

</x-app-layout>
