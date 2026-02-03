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

        <!-- CONTENEDOR PRINCIPAL PARA LAS SECCIONES -->
        <div id="professionals-container">
            @if($professionals->isEmpty())
                <div class="text-center text-gray-500 py-8">
                    <p class="text-lg">No hi ha professionals registrats.</p>
                </div>
            @else
                @php
                    $groupedProfessionals = $professionals->groupBy('profession');
                @endphp

                @foreach($groupedProfessionals as $profession => $professionalsGroup)
                    <div class="profession-section flex flex-col gap-5 mb-8" data-profession="{{ strtolower($profession) }}">
                        <!-- Botón para colapsar esta profesión -->
                        <button class="section-btn flex gap-4 items-center group" data-profession="{{ $profession }}">
                            <svg class="w-6 h-6 text-primary_color transition-transform duration-300 section-arrow" data-profession="{{ $profession }}" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-2xl text-primary_color font-mclaren group-hover:text-primary_color/80 transition-colors">
                                {{ ucfirst($profession) }}s
                            </span>
                            <div class="h-[1px] bg-primary_color w-full group-hover:bg-primary_color/80 transition-colors"></div>
                        </button>

                        <!-- Contenido de la sección -->
                        <div class="section-content grid grid-rows-auto grid-cols-5 gap-16 transition-all duration-300 ease-in-out" id="section-{{ $profession }}">
                            @foreach($professionalsGroup as $professional)
                                <div class="professional-card" data-name="{{ strtolower($professional->name . ' ' . $professional->surname) }}" data-profession="{{ strtolower($professional->profession) }}">
                                    <a class="items-center w-fit bg-white py-5 px-8 rounded-xl flex flex-col shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] hover:shadow-[5px_5px_20px_5px_rgba(0,0,0,0.15)] transition-shadow" 
                                       href="{{ route('professional.show', $professional->id)}}">
                                        <x-profile-photo :user="$professional" size="lg" />
                                        <span class="mt-5 text-lg font-medium">{{ $professional->name }} {{ $professional->surname }}</span>
                                        <span class="text-primary_color text-sm">{{ $professional->profession }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- Mensaje cuando no hay resultados -->
                <div id="no-results" class="hidden text-center text-gray-500 py-8">
                    <p class="text-lg">No s'han trobat professionals amb aquest nom.</p>
                    <p class="text-sm mt-2">Prova amb un altre nom o neteja la cerca.</p>
                </div>
            @endif
        </div>

        <x-add-button href="{{ route('professional.create') }}"></x-add-button>
    </div>  

    <script src="{{ asset('js/search-professional.js') }}"></script>
</x-app-layout>