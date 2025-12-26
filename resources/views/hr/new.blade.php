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
        <h1 class="text-2xl font-bold mb-4">Nou Cas HR</h1>

        <form action="{{ route('hr.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Professional Afectat --}}
                <div>
                    <label for="affected_professional" class="block text-sm font-medium text-gray-700">Professional Afectat *</label>
                    <select id="affected_professional" name="affected_professional" required class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                        <option value="">-- Selecciona un professional --</option>
                        @foreach($affected_professional as $professional)
                            <option value="{{ $professional->id }}" {{ old('affected_professional') == $professional->id ? 'selected' : '' }}>
                                {{ $professional->name }} {{ $professional->surname }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('affected_professional')" class="mt-2" />
                </div>

                {{-- Assignat A --}}
                <div>
                    <label for="assigned_to" class="block text-sm font-medium text-gray-700">Assignat A *</label>
                    <select id="assigned_to" name="assigned_to" required class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                        <option value="">-- Selecciona un professional --</option>
                        @foreach($assigned_to as $professional)
                            <option value="{{ $professional->id }}" {{ old('assigned_to') == $professional->id ? 'selected' : '' }}>
                                {{ $professional->name }} {{ $professional->surname }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('assigned_to')" class="mt-2" />
                </div>

                {{-- Derivat a (nullable) --}}
                <div>
                    <label for="derivated_to" class="block text-sm font-medium text-gray-700">Derivat a (opcional)</label>
                    <select id="derivated_to" name="derivated_to" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                        <option value="">-- Selecciona un professional --</option>
                        <option value="">No derivat</option>
                        @foreach($derivated_to as $professional)
                            <option value="{{ $professional->id }}" {{ old('derivated_to') == $professional->id ? 'selected' : '' }}>
                                {{ $professional->name }} {{ $professional->surname }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('derivated_to')" class="mt-2" />
                </div>
            </div>

            {{-- Descripció --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descripció *</label>
                <textarea id="description" name="description" rows="3" placeholder="Descripció del cas..." class="mt-1 block w-full border-gray-300 focus:border-primary_color focus:ring-primary_color rounded-md shadow-sm">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            {{-- Documents Adjunts --}}
            <div>
                <label for="attached_docs" class="block text-sm font-medium text-gray-700">Documents Adjunts (opcional)</label>
                <x-text-input id="attached_docs" name="attached_docs" type="text" placeholder="Nom dels documents..." class="mt-1 block w-full" :value="old('attached_docs')" />
                <x-input-error :messages="$errors->get('attached_docs')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-4">
                <x-primary-button>
                    Acceptar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>