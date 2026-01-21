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
        <h1 class="text-2xl font-bold mb-4">Nou contacte</h1>

        <form action="{{ route('outsiders.store') }}" method="POST" class="space-y-4">
            @csrf
                <x-text-input id="fullname" name="fullname" type="text" 
                    placeholder="Nombre completo" class="mt-1 block w-full" :value="old('fullname')" />

                <x-text-input id="email" name="email" type="email" 
                    placeholder="correo@ejemplo.com" class="mt-1 block w-full" :value="old('email')" />

                <x-text-input id="phone" name="phone" type="text" 
                    placeholder="123456789" class="mt-1 block w-full" :value="old('phone')" />

                <x-text-input id="service" name="service" type="text" 
                    placeholder="Servei" class="mt-1 block w-full" :value="old('service')" />

                <div>
                    <label for="task" class="block text-sm font-medium text-gray-700 mb-1">Tasca</label>
                    <select id="task" name="task" class="mt-1 block w-full border-gray-300 focus:border-primary_color focus:ring-primary_color rounded-md shadow-sm" required>
                        <option value="">Selecciona una tasca</option>
                        <option value="General" {{ old('task') == 'General' ? 'selected' : '' }}>General</option>
                        <option value="Assistencial" {{ old('task') == 'Assistencial' ? 'selected' : '' }}>Assistencial</option>
                    </select>
                </div>

                <x-text-input id="business" name="business" type="text" 
                    placeholder="Empresa" class="mt-1 block w-full" :value="old('business')" />

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Observacions</label>
                    <x-trix-input id="description" name="description" :value="old('description')" autocomplete="off" class="border-0 border-b border-b-[#ff9740] placeholder-[#ff9740] py-2 px-0 focus:outline-none" />
                </div>

            <div class="flex justify-end mt-4">
                <x-primary-button>
                    Crear
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
