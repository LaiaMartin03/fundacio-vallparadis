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

        <h1 class="text-2xl font-bold mb-4">Crear servei</h1>

        <form action="{{ route('serveis.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Nom --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" 
                    class="mt-1 block w-full border-gray-300 focus:border-primary_color focus:ring-primary_color rounded-md shadow-sm" 
                    value="{{ old('name') }}" required>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            {{-- Descripció --}}
            <div>
                <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">Descripció <span class="text-red-500">*</span></label>
                <textarea id="desc" name="desc" rows="4" 
                    class="mt-1 block w-full border-gray-300 focus:border-primary_color focus:ring-primary_color rounded-md shadow-sm" 
                    required>{{ old('desc') }}</textarea>
                <x-input-error :messages="$errors->get('desc')" class="mt-2" />
            </div>

            {{-- Observacions --}}
            <div>
                <label for="observacions" class="block text-sm font-medium text-gray-700 mb-1">Observacions</label>
                <textarea id="observacions" name="observacions" rows="3" 
                    class="mt-1 block w-full border-gray-300 focus:border-primary_color focus:ring-primary_color rounded-md shadow-sm">{{ old('observacions') }}</textarea>
                <x-input-error :messages="$errors->get('observacions')" class="mt-2" />
            </div>

            {{-- Responsable (User) --}}
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Responsable</label>
                <select name="user_id" id="user_id" class="form-select w-full border-gray-300 focus:border-primary_color focus:ring-primary_color rounded-md shadow-sm">
                    <option value="">— Selecciona responsable —</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} {{ $user->surname ?? '' }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
            </div>

            {{-- Document intern --}}
            <div>
                <label for="internal_doc_id" class="block text-sm font-medium text-gray-700 mb-1">Document intern relacionat</label>
                <select name="internal_doc_id" id="internal_doc_id" class="form-select w-full border-gray-300 focus:border-primary_color focus:ring-primary_color rounded-md shadow-sm">
                    <option value="">— Selecciona document —</option>
                    @foreach ($internalDocs as $doc)
                        <option value="{{ $doc->id }}" {{ old('internal_doc_id') == $doc->id ? 'selected' : '' }}>
                            {{ $doc->title }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('internal_doc_id')" class="mt-2" />
            </div>

            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ route('serveis.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg transition">
                    Cancel·lar
                </a>
                <x-primary-button>
                    Crear
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
