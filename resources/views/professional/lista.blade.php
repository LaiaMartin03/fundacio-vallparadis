<x-app-layout>  
    <div class="ml-20 px-20 py-10 space-y-10">
        <div id="header" class="flex justify-between items-center">
            <h1 class="font-mclaren text-primary_color text-4xl">Professionals</h1>
            
            <a href="{{ route('professionals.export') }}">
                <x-primary-button> Exportar a Excel</x-primary-button>
            </a>
        </div>

        <div id="filters" class="p-5 border"></div>

        <div class="flex flex-col gap-5">
            <button class="flex gap-4 items-center" onclick="collapseProfesionals()">
                <span class="text-2xl text-primary_color font-mclaren">Psicòlegs</span>
                <div class="h-[1px] bg-primary_color w-full"></div>
            </button>

            <div class="grid grid-rows-auto grid-cols-5 gap-16 transition-all duration-300 ease-in-out" id="section">                
                @if($professionals->isEmpty())
                    <p>No hi ha professionals registrats.</p>
                @else
                    @foreach($professionals as $professional)
                        <a class="items-center w-fit bg-white py-5 px-8 rounded-xl flex flex-col shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]" href="{{ route('professional.show', $professional->id)}}">
                            <img class="rounded-full w-40 m-auto aspect-square object-cover" src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" alt="">
                            <span class="mt-5 text-lg">{{ $professional->name }}</span>
                            <span class="text-primary_color text-sm">Psícologo</span>
                        </a>
                    @endforeach
                @endif
            </div>

            <x-add-button href="{{ route('professional.create') }}"></x-add-button>

            <!--<x-modal-form titulo="Nou Professional" id="modal" class="">
                <form action="{{ route('professional.store') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Nom --}}
                    <x-text-input 
                        id="name" 
                        name="name" 
                        type="text" 
                        placeholder="Nom" 
                        class="mt-1 block w-full"
                        :value="old('name')" 
                        required
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    {{-- Email --}}
                    <x-text-input 
                        id="email" 
                        name="email" 
                        type="email" 
                        placeholder="Correu electrònic" 
                        class="mt-1 block w-full" 
                        :value="old('email')" 
                        required
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    {{-- Contrasenya --}}
                    <x-text-input 
                        id="password" 
                        name="password" 
                        type="password" 
                        placeholder="Contrasenya" 
                        class="mt-1 block w-full" 
                        required
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    {{-- Número de taquilla --}}
                    <x-text-input 
                        id="locker" 
                        name="locker" 
                        type="text" 
                        placeholder="Número de taquilla" 
                        class="mt-1 block w-full" 
                        :value="old('locker')" 
                    />
                    <x-input-error :messages="$errors->get('locker')" class="mt-2" />

                    {{-- Codi de taquilla --}}
                    <x-text-input 
                        id="code" 
                        name="code" 
                        type="text" 
                        placeholder="Codi de taquilla" 
                        class="mt-1 block w-full" 
                        :value="old('code')" 
                    />
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />

                    {{-- Actiu / Inactiu --}}
                    <div class="flex items-center gap-6 mt-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input 
                                type="radio" 
                                name="active" 
                                value="1" 
                                class="accent-blue-600 focus:ring-primary_color"
                                {{ old('active', '1') === '1' ? 'checked' : '' }}
                            >
                            <span>Actiu</span>
                        </label>
                        
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input 
                                type="radio" 
                                name="active" 
                                value="0" 
                                class="accent-blue-600 focus:ring-primary_color"
                                {{ old('active') === '0' ? 'checked' : '' }}
                            >
                            <span>Inactiu</span>
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('active')" class="mt-2" />

                    {{-- Botó --}}
                    <div class="flex justify-end mt-4">
                        <x-primary-button>
                            Aceptar
                        </x-primary-button>
                    </div>
                </form>
            </x-modal-form>-->
        </div>
    </div>  
</x-app-layout>  