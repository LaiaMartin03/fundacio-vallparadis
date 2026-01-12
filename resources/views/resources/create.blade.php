<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white rounded-xl">
        <h1 class="text-2xl font-bold mb-4">Nova Entrega de Material</h1>

        <form method="POST" action="{{ route('resources.store') }}" class="space-y-4">
            @csrf

            {{-- Uniform --}}
            <x-text-input id="shirt_size" name="shirt_size" type="number" class="mt-1 block w-full" :value="old('shirt_size')" placeholder="Samarreta" />
            <x-input-error :messages="$errors->get('shirt_size')" class="mt-2" />
            
            <x-text-input id="pants_size" name="pants_size" type="number" class="mt-1 block w-full" :value="old('pants_size')" placeholder="Pantalons" />
            <x-input-error :messages="$errors->get('pants_size')" class="mt-2" />
            
            <x-input-label for="lab_coat" :value="'Bata'" />
            <select id="lab_coat" name="lab_coat" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Selecciona una opción</option>
                <option value="1" {{ old('lab_coat') === '1' ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ old('lab_coat') === '0' ? 'selected' : '' }}>No</option>
            </select>
            <x-input-error :messages="$errors->get('lab_coat')" class="mt-2" />

            <x-text-input id="shoe_size" name="shoe_size" type="number" class="mt-1 block w-full" :value="old('shoe_size')" placeholder="Sabates" />
            <x-input-error :messages="$errors->get('shoe_size')" class="mt-2" />

            <x-input-error :messages="$errors->get('uniform_id')" class="mt-2" />

            {{-- Usuario que recibe --}}
            <x-input-label for="user_id" :value="'Usuario receptor'" />
            <select id="user_id" name="user_id" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Selecciona un usuario</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />

            {{-- Usuario que entrega --}}
            <x-input-label for="given_by_user_id" :value="'Entregado por'" />
            <select id="given_by_user_id" name="given_by_user_id" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Selecciona un usuario</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('given_by_user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('given_by_user_id')" class="mt-2" />

            {{-- Fecha de entrega --}}
            <x-input-label for="delivered_at" :value="'Fecha de entrega'" />
            <x-text-input id="delivered_at" name="delivered_at" type="datetime-local" class="mt-1 block w-full" :value="old('delivered_at')" />
            <x-input-error :messages="$errors->get('delivered_at')" class="mt-2" />

            {{-- Botón de envío --}}
            <div class="flex justify-end mt-4">
                <x-primary-button>
                    Crear recurso
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
