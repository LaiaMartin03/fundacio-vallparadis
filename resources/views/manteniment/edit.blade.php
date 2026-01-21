<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white rounded-xl">

        @if (session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
        @elseif ($errors->any())
            <div class="text-red-600 mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="text-2xl font-bold mb-4">Editar entrada</h1>

        <form action="{{ route('manteniment.update', $manteniment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Tipo --}}
            <div>
                <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                <select name="tipo" id="tipo" class="form-select w-full" required>
                    <option value="">— Selecciona tipo —</option>
                    <option value="manteniment" {{ old('tipo', $manteniment->tipo) == 'manteniment' ? 'selected' : '' }}>Mantenimiento</option>
                    <option value="seguiment" {{ old('tipo', $manteniment->tipo) == 'seguiment' ? 'selected' : '' }}>Seguimiento</option>
                </select>
                <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
            </div>

            {{-- Fecha --}}
            <div>
                <label for="data" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                <x-text-input id="data" name="data" type="date" class="mt-1 block w-full" :value="old('data', $manteniment->data->format('Y-m-d'))" required />
                <x-input-error :messages="$errors->get('data')" class="mt-2" />
            </div>

            {{-- Descripción --}}
            <div>
                <label for="descripcio" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea id="descripcio" name="descripcio" rows="4" placeholder="Descripción" class="mt-1 block w-full border-gray-300 focus:border-primary_color focus:ring-primary_color rounded-md shadow-sm" required>{{ old('descripcio', $manteniment->descripcio) }}</textarea>
                <x-input-error :messages="$errors->get('descripcio')" class="mt-2" />
            </div>

            {{-- Responsable / Profesional --}}
            <div>
                <label for="responsable_id" class="block text-sm font-medium text-gray-700 mb-1">Responsable</label>
                <select name="responsable_id" id="responsable_id" class="form-select w-full" required>
                    <option value="">— Selecciona responsable —</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('responsable_id', $manteniment->responsable_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} {{ $user->surname ?? '' }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('responsable_id')" class="mt-2" />
            </div>

            {{-- Archivos adjuntos actuales --}}
            @if($manteniment->docs_adjunts && count($manteniment->docs_adjunts) > 0)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Documentos adjuntos actuales</label>
                <div class="bg-gray-50 p-3 rounded-lg space-y-2">
                    @foreach($manteniment->docs_adjunts as $doc)
                        <div class="flex items-center justify-between p-2 bg-white rounded border">
                            <span class="text-sm text-gray-700">{{ basename($doc) }}</span>
                            <a href="{{ asset('storage/' . $doc) }}" target="_blank" class="text-primary_color hover:text-primary_color/80 text-sm font-medium">
                                Ver documento
                            </a>
                        </div>
                    @endforeach
                </div>
                <p class="text-sm text-gray-500 mt-1">Los nuevos archivos reemplazarán los existentes</p>
            </div>
            @endif

            {{-- Archivos adjuntos nuevos --}}
            <div>
                <label for="docs_adjunts" class="block text-sm font-medium text-gray-700 mb-1">Nuevos archivos adjuntos (opcional)</label>
                <input type="file" name="docs_adjunts[]" id="docs_adjunts" multiple class="mt-2 block w-full" />
                <p class="text-sm text-gray-500 mt-1">Puedes seleccionar múltiples archivos. Máximo 10MB por archivo.</p>
                <x-input-error :messages="$errors->get('docs_adjunts.*')" class="mt-2" />
            </div>

            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ route('manteniment.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg transition">
                    Cancelar
                </a>
                <x-primary-button>
                    Actualizar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
