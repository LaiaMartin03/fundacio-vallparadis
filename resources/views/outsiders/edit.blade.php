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
        <h1 class="text-2xl font-bold mb-4">Editar contacte extern</h1>

        <form action="{{ route('outsiders.update', $outsider) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <x-text-input id="fullname" name="fullname" type="text" 
                placeholder="Nombre completo" class="mt-1 block w-full" :value="old('fullname', $outsider->fullname)" />

            <x-text-input id="email" name="email" type="email" 
                placeholder="correo@ejemplo.com" class="mt-1 block w-full" :value="old('email', $outsider->email)" />

            <x-text-input id="phone" name="phone" type="text" 
                placeholder="123456789" class="mt-1 block w-full" :value="old('phone', $outsider->phone)" />

            <x-text-input id="service" name="service" type="text" 
                placeholder="Servei" class="mt-1 block w-full" :value="old('service', $outsider->service)" />

            <div>
                <label for="task" class="block text-sm font-medium text-gray-700 mb-1">Tasca</label>
                <select id="task" name="task" class="mt-1 block w-full border-gray-300 focus:border-primary_color focus:ring-primary_color rounded-md shadow-sm" required>
                    <option value="">Selecciona una tasca</option>
                    <option value="General" {{ old('task', $outsider->task) == 'General' ? 'selected' : '' }}>General</option>
                    <option value="Assistencial" {{ old('task', $outsider->task) == 'Assistencial' ? 'selected' : '' }}>Assistencial</option>
                </select>
            </div>

            <x-text-input id="business" name="business" type="text" 
                placeholder="Empresa" class="mt-1 block w-full" :value="old('business', $outsider->business)" />

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Observacions</label>
                <x-trix-input id="description" name="description" :value="old('description', $outsider->description)" autocomplete="off" class="border-0 border-b border-b-[#ff9740] placeholder-[#ff9740] py-2 px-0 focus:outline-none" />
            </div>

            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ route('outsiders.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg transition">
                    Cancel·lar
                </a>
                <x-primary-button>
                    Actualitzar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
