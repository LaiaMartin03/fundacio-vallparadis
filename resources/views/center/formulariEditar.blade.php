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

        <h1 class="text-2xl font-bold mb-4">Editar Centre: {{ $center->name }}</h1>

        <form action="{{ route('center.update', $center->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <x-text-input id="name" name="name" type="text" placeholder="Nom del centre" class="mt-1 block w-full" :value="old('name', $center->name)" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            <x-text-input id="location" name="location" type="text" placeholder="Adreça" class="mt-1 block w-full" :value="old('location', $center->location)" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />

            <x-text-input id="email" name="email" type="email" placeholder="Correu electrònic" class="mt-1 block w-full" :value="old('email', $center->email)" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <x-text-input id="phone" name="phone" type="text" placeholder="Número de teléfon" class="mt-1 block w-full" :value="old('phone', $center->phone)" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />

            <div class="flex items-center gap-6 mt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="active" value="1" class="text-blue-600 focus:ring-blue-500"
                        {{ old('active', $center->active) === 1 || old('active', $center->active) === "1" ? 'checked' : '' }}>
                    <span>Activo</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="active" value="0" class="text-blue-600 focus:ring-blue-500"
                        {{ old('active', $center->active) === 0 || old('active', $center->active) === "0" ? 'checked' : '' }}>
                    <span>Inactivo</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('active')" class="mt-2" />

            <div class="flex justify-end mt-4">
                <x-primary-button>
                    Actualizar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
