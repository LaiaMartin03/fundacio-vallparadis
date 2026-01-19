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

        <h1 class="text-2xl font-bold mb-4">Crear entrada</h1>

        <form action="{{ route('manteniment.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            {{-- Tipo --}}
            <select name="tipo" class="form-select w-full" required>
                <option value="">— Selecciona tipo —</option>
                <option value="manteniment" {{ old('tipo') == 'manteniment' ? 'selected' : '' }}>Manteniment</option>
                <option value="seguiment" {{ old('tipo') == 'seguiment' ? 'selected' : '' }}>Seguiment</option>
            </select>

            {{-- Fecha --}}
            <x-text-input id="data" name="data" type="date" class="mt-1 block w-full" :value="old('data')" required />

            {{-- Descripción --}}
            <x-text-input id="descripcio" name="descripcio" type="text" placeholder="Descripción" class="mt-1 block w-full" :value="old('descripcio')" required />

            {{-- Responsable / Profesional --}}
            <select name="responsable_id" class="form-select w-full" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('responsable_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>

            {{-- Archivos adjuntos --}}
            <input type="file" name="docs_adjunts[]" multiple class="mt-2 block w-full" />

            <div class="flex justify-end mt-4">
                <x-primary-button>Crear</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
