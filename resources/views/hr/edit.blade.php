<x-app-layout>
    {{-- Mensajes de éxito o errores --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Editar Cas HR #{{ $hr->id }}</h1>
            
            {{-- Estado actual del caso --}}
            <div class="px-4 py-2 rounded-full {{ $hr->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $hr->active ? 'Actiu' : 'Inactiu' }}
            </div>
        </div>

        <form action="{{ route('hr.update', $hr->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Professional Afectat --}}
                <div>
                    <label for="affected_professional" class="block text-sm font-medium text-gray-700 mb-1">Professional Afectat *</label>
                    <select id="affected_professional" name="affected_professional" required 
                        class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">-- Selecciona un professional --</option>
                        @foreach($affected_professional as $professional)
                            <option value="{{ $professional->id }}" 
                                {{ old('affected_professional', $hr->affected_professional) == $professional->id ? 'selected' : '' }}>
                                {{ $professional->name }} {{ $professional->surname }}
                            </option>
                        @endforeach
                    </select>
                    @error('affected_professional')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Assignat A --}}
                <div>
                    <label for="assigned_to" class="block text-sm font-medium text-gray-700 mb-1">Assignat A *</label>
                    <select id="assigned_to" name="assigned_to" required 
                        class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">-- Selecciona un professional --</option>
                        @foreach($assigned_to as $professional)
                            <option value="{{ $professional->id }}" 
                                {{ old('assigned_to', $hr->assigned_to) == $professional->id ? 'selected' : '' }}>
                                {{ $professional->name }} {{ $professional->surname }}
                            </option>
                        @endforeach
                    </select>
                    @error('assigned_to')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Derivat a (nullable) --}}
                <div>
                    <label for="derivated_to" class="block text-sm font-medium text-gray-700 mb-1">Derivat a (opcional)</label>
                    <select id="derivated_to" name="derivated_to" 
                        class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">-- Selecciona un professional --</option>
                        <option value="" {{ old('derivated_to', $hr->derivated_to) == '' ? 'selected' : '' }}>No derivat</option>
                        @foreach($derivated_to as $professional)
                            <option value="{{ $professional->id }}" 
                                {{ old('derivated_to', $hr->derivated_to) == $professional->id ? 'selected' : '' }}>
                                {{ $professional->name }} {{ $professional->surname }}
                            </option>
                        @endforeach
                    </select>
                    @error('derivated_to')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Descripció --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripció *</label>
                <textarea id="description" name="description" rows="4" 
                    placeholder="Descripció del cas..." 
                    class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('description', $hr->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Documents Adjunts --}}
            <div>
                <label for="attached_docs" class="block text-sm font-medium text-gray-700 mb-1">Documents Adjunts (opcional)</label>
                <input id="attached_docs" name="attached_docs" type="text" 
                    placeholder="Nom dels documents..." 
                    value="{{ old('attached_docs', $hr->attached_docs) }}"
                    class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                @error('attached_docs')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                <div>
                    {{-- Botón para marcar como inactivo --}}
                    <button type="button" 
                        onclick="confirmDelete()"
                        class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200 {{ $hr->active ? '' : 'opacity-50 cursor-not-allowed' }}"
                        {{ $hr->active ? '' : 'disabled' }}>
                        Desactivar Cas
                    </button>
                </div>
                
                <div class="flex space-x-4">
                    <a href="{{ route('hr.index') }}" 
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                        Tornar a la llista
                    </a>
                    <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                        Actualitzar Cas
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Formulario oculto para desactivar --}}
    <form id="deleteForm" action="{{ route('hr.destroy', $hr->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function confirmDelete() {
            if (confirm('¿Estàs segur que vols desactivar aquest cas? No s\'eliminarà, però es posarà com a inactiu.')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
</x-app-layout>