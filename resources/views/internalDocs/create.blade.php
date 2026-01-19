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
        <h1 class="text-2xl font-bold mb-4">Nou servei</h1>

        <form action="{{ route('serveis.store') }}" method="POST" class="space-y-4">
            @csrf
                <x-text-input id="name" name="name" type="text" 
                    placeholder="Nom del document" class="mt-1 block w-full" :value="old('name')" />

                <x-text-input id="tipus" name="tipus" type="text" 
                    placeholder="Tipus" class="mt-1 block w-full" :value="old('tipus')" />

                <label for="observacions" class="text-orange-400 -mb-1 mt-3">Observacions</label>
                <x-trix-input id="observacions" name="observacions" :value="old('observacions')" autocomplete="off" class="border-0 border-b border-b-[#ff9740] placeholder-[#ff9740] py-2 px-0 focus:outline-none" />

                <label for="description" class="text-orange-400 -mb-1 mt-3">Descripció</label>
                <x-trix-input id="description" name="description" :value="old('description')" autocomplete="off" class="border-0 border-b border-b-[#ff9740] placeholder-[#ff9740] py-2 px-0 focus:outline-none" />

            <div class="flex justify-end mt-4">
                <x-primary-button>
                    Crear
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
