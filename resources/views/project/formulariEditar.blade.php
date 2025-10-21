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
        <h1 class="text-2xl font-bold mb-4">Editar Projecte: {{ $project->name }}</h1>

        <form action="{{ route('project.update', $project->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <select id="center_id" name="center_id" required class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                <option value="">-- Selecciona un centre --</option>
                @foreach($centers as $center)
                    <option value="{{ $center->id }}" {{ old('center_id', $project->center_id) == $center->id ? 'selected' : '' }}>
                        {{ $center->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('center_id')" class="mt-2" />

            <select id="responsible_professional" name="responsible_professional" required class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                <option value="">-- Selecciona un professional --</option>
                @foreach($professionals as $professional)
                    <option value="{{ $professional->id }}" {{ old('responsible_professional', $project->responsible_professional) == $professional->id ? 'selected' : '' }}>
                        {{ $professional->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('responsible_professional')" class="mt-2" />

            <x-text-input id="name" name="name" type="text" placeholder="Nom del Projecte" class="mt-1 block w-full" :value="old('name', $project->name)" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            <x-text-input id="description" name="description" type="text" placeholder="Descripció del Projecte" class="mt-1 block w-full" :value="old('description', $project->description)" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />

            <x-text-input id="observations" name="observations" type="text" placeholder="Observacions del Projecte" class="mt-1 block w-full" :value="old('observations', $project->observations)" />
            <x-input-error :messages="$errors->get('observations')" class="mt-2" />

            <div class="flex items-center gap-6 mt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="type" value="project" class="text-blue-600 focus:ring-blue-500"
                        {{ old('type', $project->type) == 'project' ? 'checked' : '' }}>
                    <span>Projecte</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="type" value="comision" class="text-blue-600 focus:ring-blue-500"
                        {{ old('type', $project->type) == 'comision' ? 'checked' : '' }}>
                    <span>Comisió</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('type')" class="mt-2" />

            <div class="flex items-center gap-6 mt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="active" value="1" class="text-blue-600 focus:ring-blue-500"
                        {{ old('active', $project->active) == "1" ? 'checked' : '' }}>
                    <span>Actiu</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="active" value="0" class="text-blue-600 focus:ring-blue-500"
                        {{ old('active', $project->active) == "0" ? 'checked' : '' }}>
                    <span>Inactiu</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('active')" class="mt-2" />

            <div class="flex justify-end mt-4">
                <x-primary-button>
                    Acceptar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
