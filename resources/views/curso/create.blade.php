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
        <h1 class="text-2xl font-bold mb-4">Nou Contacte</h1>

        <form action="{{ route('outsiders.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Name --}}
            <div>
                <x-input-label for="name" :value="__('Nom del contacte')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block> w-full" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" /> 
            </div>
            
            <div class="flex justify-end mt-4">
                <x-primary-button>
                    Crear
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
