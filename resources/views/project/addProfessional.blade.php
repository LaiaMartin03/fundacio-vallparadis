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
        <h1 class="text-2xl font-bold mb-4">Afegir professional al projecte</h1>

        <form action="{{ route('project.storeProfessional', $project->id) }}" method="POST" class="space-y-4">
            @csrf

            <select id="professional_id" name="professional_id" required class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                <option value="">-- Selecciona un professional --</option>
                @foreach($professionals as $professional)
                    <option value="{{ $professional->id }}" {{ old('professional_id') == $professional->id ? 'selected' : '' }}>
                        {{ $professional->name }} {{ $professional->surname ?? '' }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('professional_id')" class="mt-2" />

            <div class="flex justify-end mt-4">
                <x-primary-button>
                    Afegir
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
