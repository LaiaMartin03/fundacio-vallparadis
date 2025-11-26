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
        <h1 class="text-2xl font-bold mb-4">Nou Curs</h1>

        <form action="{{ route('curso.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Name --}}
            <div>
                <x-input-label for="name" :value="__('Nom del curs')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block> w-full" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" /> 
            </div>


            {{-- Forcem --}}
            <div>   
                <label for="forcem" class="block text-sm font-medium text-gray-700">Forcem</label>
                <x-text-input id="forcem" name="forcem" type="number" step="1" class="mt-1 block w-full" :value="old('forcem')" />
                <x-input-error :messages="$errors->get('forcem')" class="mt-2" />
            </div>

            {{-- Hours --}}
            <div>
                <label for="hours" class="block text-sm font-medium text-gray-700">Hores</label>
                <x-text-input id="hours" name="hours" type="number" step="0.1" placeholder="Hores" class="mt-1 block w-full" :value="old('hours')" />
                <x-input-error :messages="$errors->get('hours')" class="mt-2" />
            </div>

            {{-- Type --}}
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Tipus</label>
                <select id="type" name="type" required class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                    <option value="">-- Selecciona un tipus --</option>
                    <option value="Formació Interna" {{ old('type') == 'Formació Interna' ? 'selected' : '' }}>Formació Interna</option>
                    <option value="Formació Externa" {{ old('type') == 'Formació Externa' ? 'selected' : '' }}>Formació Externa</option>
                    <option value="Formació Salut laboral" {{ old('type') == 'Formació Salut laboral' ? 'selected' : '' }}>Formació Salut laboral</option>
                    <option value="Jorn/Taller/Seminari/Congrès" {{ old('type') == 'Jorn/Taller/Seminari/Congrès' ? 'selected' : '' }}>Jorn/Taller/Seminari/Congrès</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            {{-- Modality --}}
            <div>
                <label for="modality" class="block text-sm font-medium text-gray-700">Modalitat</label>
                <select id="modality" name="modality" required class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                    <option value="">-- Selecciona una modalitat --</option>
                    <option value="Presencial" {{ old('modality') == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                    <option value="Online" {{ old('modality') == 'Online' ? 'selected' : '' }}>Online</option>
                    <option value="Híbrid" {{ old('modality') == 'Mixte' ? 'selected' : '' }}>Mixte</option>
                </select>
                <x-input-error :messages="$errors->get('modality')" class="mt-2" />
            </div>
            {{-- Info --}}
            <div>
                <label for="info" class="block text-sm font-medium text-gray-700">Informació</label>
                <textarea id="info" name="info" rows="3" placeholder="Informació addicional" class="mt-1 block w-full border-gray-300 focus:border-primary_color focus:ring-primary_color rounded-md shadow-sm">{{ old('info') }}</textarea>
                <x-input-error :messages="$errors->get('info')" class="mt-2" />
            </div>

            {{-- Start Date --}}
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Data d'Inici</label>
                <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date')" />
                <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
            </div>

            {{-- Finish Date --}}
            <div>
                <label for="finish_date" class="block text-sm font-medium text-gray-700">Data de Finalització</label>
                <x-text-input id="finish_date" name="finish_date" type="date" class="mt-1 block w-full" :value="old('finish_date')" />
                <x-input-error :messages="$errors->get('finish_date')" class="mt-2" />
            </div>
      
            <div class="flex justify-end mt-4">
                <x-primary-button>
                    Acceptar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
