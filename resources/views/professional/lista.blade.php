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

            <x-modal-form titulo="Nuevo usuario">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="block text-sm font-medium">Nombre</label>
                        <input 
                            type="text" 
                            id="nombre" 
                            name="nombre" 
                            class="w-full border border-gray-300 rounded p-2"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="w-full border border-gray-300 rounded p-2"
                            required
                        >
                    </div>

                    <button 
                        type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    >
                        Guardar
                    </button>
                </form>
            </x-modal-form>

        </div>
    </div>  
</x-app-layout>  