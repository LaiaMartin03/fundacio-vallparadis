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
        <h1 class="text-2xl font-bold mb-4">Editar Profesional: {{ $professional->name }}</h1>


        <form action="{{ route('professional.update', $professional->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <x-text-input id="name" name="name" type="text" placeholder="Nom" class="mt-1 block w-full" :value="old('name', $professional->name)" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            <x-text-input id="email" name="email" type="email" placeholder="Correu electrònic" class="mt-1 block w-full" :value="old('email', $professional->email)" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <x-text-input id="password" name="password" type="password" placeholder="Contrasenya" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <x-text-input id="locker" name="locker" type="text" placeholder="Número de taquilla" class="mt-1 block w-full" :value="old('locker', $professional->locker)" />
            <x-input-error :messages="$errors->get('locker')" class="mt-2" />

            <x-text-input id="code" name="code" type="text" placeholder="Codi de taquilla" class="mt-1 block w-full" :value="old('code', $professional->code)" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />

            <div class="flex items-center gap-6 mt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        name="active"
                        value="1"
                        class="accent-blue-600 focus:ring-primary_color"
                        {{ old('active', $professional->active) == "1" ? 'checked' : '' }}
                    >
                    <span>Actiu</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        name="active"
                        value="0"
                        class="accent-blue-600 focus:ring-primary_color"
                        {{ old('active', $professional->active) == "0" ? 'checked' : '' }}
                    >
                    <span>Inactiu</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('active')" class="mt-2" />

            <div class="flex justify-end mt-4">
                <x-primary-button>
                    Aceptar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
