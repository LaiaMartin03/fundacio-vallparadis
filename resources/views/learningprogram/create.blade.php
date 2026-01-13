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
        <h1 class="text-2xl font-bold mb-6">Nou Learning Program</h1>

        <form action="{{ route('learningprogram.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Curso --}}
            <div>
                <label for="curso_id" class="block text-sm font-medium text-gray-700">Curs</label>
                <select id="curso_id" name="curso_id" required class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                    <option value="">-- Selecciona un curs --</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                            {{ $curso->name ?? $curso->forcem }} {{ $curso->type ? '- ' . $curso->type : '' }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('curso_id')" class="mt-2" />
            </div>

            {{-- User --}}
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Professional</label>
                <select id="user_id" name="user_id" required class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach($professionals as $professional)
                        <option value="{{ $professional->id }}" {{ old('professional_id') == $professional->id ? 'selected' : '' }}>
                            {{ $professional->name }} {{ $professional->surname }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('professional_id')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-6">
                <x-primary-button>
                    Crear
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>