<x-app-layout>
    <h1>Nuevo Uniforme</h1>

    <form method="POST" action="{{ route('uniforms.store') }}" class="space-y-4">
        @csrf

        {{-- Shirt Size --}}
        <x-input-label for="shirt_size" :value="'Talla de camiseta'" />
        <x-text-input
            id="shirt_size"
            name="shirt_size"
            type="number"
            class="mt-1 block w-full"
            :value="old('shirt_size')"
        />
        <x-input-error :messages="$errors->get('shirt_size')" class="mt-2" />

        {{-- Pants Size --}}
        <x-input-label for="pants_size" :value="'Talla de pantalón'" />
        <x-text-input
            id="pants_size"
            name="pants_size"
            type="number"
            class="mt-1 block w-full"
            :value="old('pants_size')"
        />
        <x-input-error :messages="$errors->get('pants_size')" class="mt-2" />

        {{-- Lab Coat --}}
        <div class="flex items-center gap-2 mt-2">
            <x-checkbox id="lab_coat" name="lab_coat" :checked="old('lab_coat')" />
            <label for="lab_coat" class="text-sm text-gray-600">Bata de laboratorio</label>
        </div>
        <x-input-error :messages="$errors->get('lab_coat')" class="mt-2" />

        {{-- Shoe Size --}}
        <x-input-label for="shoe_size" :value="'Talla de zapatos'" />
        <x-text-input
            id="shoe_size"
            name="shoe_size"
            type="number"
            class="mt-1 block w-full"
            :value="old('shoe_size')"
        />
        <x-input-error :messages="$errors->get('shoe_size')" class="mt-2" />

        {{-- Botón de envío --}}
        <div class="flex justify-end mt-4">
            <x-primary-button>
                Crear uniforme
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
