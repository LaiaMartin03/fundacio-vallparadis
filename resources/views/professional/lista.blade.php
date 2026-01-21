<x-app-layout>  
    <div class="px-20 py-10 space-y-10">
        <div id="header" class="flex justify-between items-center">
            <h1 class="font-mclaren text-primary_color text-4xl">Professionals</h1>
            
            <a href="{{ route('professionals.export') }}">
                <x-primary-button> Exportar a Excel</x-primary-button>
            </a>
        </div>

        <x-buscador 
            label="Cercar per nom" 
            placeholder="Escriu el nom del professional..." 
        />

        <div class="flex flex-col gap-5">
            <button class="flex gap-4 items-center" onclick="collapseProfesionals()">
                <span class="text-2xl text-primary_color font-mclaren">Psicòlegs</span>
                <div class="h-[1px] bg-primary_color w-full"></div>
            </button>

            <div class="grid grid-rows-auto grid-cols-5 gap-16 transition-all duration-300 ease-in-out" id="section">                
                @if($professionals->isEmpty())
                    <p class="col-span-5 text-center text-gray-500 py-8">No hi ha professionals registrats.</p>
                @else
                    @foreach($professionals as $professional)
                        <div class="professional-card" data-name="{{ strtolower($professional->name) }} {{ strtolower($professional->surname) }}">
                            <a class="items-center w-fit bg-white py-5 px-8 rounded-xl flex flex-col shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] hover:shadow-[5px_5px_20px_5px_rgba(0,0,0,0.15)] transition-shadow" 
                               href="{{ route('professional.show', $professional->id)}}">
                                <img class="rounded-full w-40 m-auto aspect-square object-cover" 
                                     src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" 
                                     alt="{{ $professional->name }}">
                                <span class="mt-5 text-lg font-medium professional-name">{{ $professional->name }} {{ $professional->surname }}</span>
                                <span class="text-primary_color text-sm">Psícologo</span>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Mensaje cuando no hay resultados -->
            <div id="no-results" class="hidden col-span-5 text-center text-gray-500 py-8">
                <p class="text-lg">No s'han trobat professionals amb aquest nom.</p>
                <p class="text-sm mt-2">Prova amb un altre nom o neteja la cerca.</p>
            </div>

            <x-add-button href="{{ route('professional.create') }}"></x-add-button>
        </div>
    </div>  

    <!-- Incluir el archivo search.js -->
    <script src="{{ asset('js/search-professional.js') }}"></script>
</x-app-layout>