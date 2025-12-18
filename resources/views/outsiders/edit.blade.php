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
        <h1 class="text-2xl font-bold mb-4">Editar Curs</h1>

        <form action="{{ route('curso.update', $curso) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            {{-- Campo active hidden --}}
            <input type="hidden" name="active" value="{{ old('active', $curso->active ?? 1) }}">

            {{-- Name --}}
            <div>
                <x-input-label for="name" :value="__('Nom del curs')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                    :value="old('name', $curso->name)" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" /> 
            </div>
            
            {{-- Info --}}
            <div>
                <label for="info" class="block text-sm font-medium text-gray-700">Informació</label>
                <textarea id="info" name="info" rows="3" placeholder="Informació addicional" class="mt-1 block w-full border-gray-300 focus:border-primary_color focus:ring-primary_color rounded-md shadow-sm">{{ old('info', $curso->info) }}</textarea>
                <x-input-error :messages="$errors->get('info')" class="mt-2" />
            </div>

            {{-- Certification --}}
            <div>
                <label for="certification" class="block text-sm font-medium text-gray-700">Certificat</label>
                <select id="certification" name="certification" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                    <option value="Pendent" {{ old('certification', $curso->certification) == 'Pendent' ? 'selected' : '' }}>Pendent</option>
                    <option value="Entregat" {{ old('certification', $curso->certification) == 'Entregat' ? 'selected' : '' }}>Entregat</option>
                </select>
                <x-input-error :messages="$errors->get('certification')" class="mt-2" />
            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ route('curso.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg transition">
                    Cancel·lar
                </a>
                <x-primary-button>
                    Actualitzar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>