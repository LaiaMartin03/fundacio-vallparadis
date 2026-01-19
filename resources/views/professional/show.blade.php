<x-app-layout>
    <div class="px-20 pb-10 flex flex-col gap-12">
        <!-- Encabezado similar al de cursos -->
        <div class="flex justify-between items-start p-2">
            <div class="flex gap-5">
                <img class="rounded-full w-[200px] aspect-square object-cover" 
                     src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?auto=format&q=80&w=300" 
                     alt="{{ $professional->name }}">
                
                <div class="flex flex-col gap-2">
                    <h1 class="font-mclaren text-primary_color text-3xl mb-2">{{ $professional->name }} {{ $professional->surname }}</h1>
                    
                    <div class="flex items-center gap-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $professional->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <span class="w-2 h-2 rounded-full {{ $professional->active ? 'bg-green-500' : 'bg-red-500' }} mr-2"></span>
                            {{ $professional->active ? 'Actiu' : 'Inactiu' }}
                        </span>
                        
                        <span class="text-gray-500">
                            Registrat el {{ \Carbon\Carbon::parse($professional->created_at)->format('d/m/Y') }}
                        </span>
                    </div>
                    
                    <!-- Información del profesional -->
                    <div class="mt-3 space-y-1 text-gray-600">
                        <p class="flex items-center gap-2">

                            {{ $professional->email }}
                        </p>
                        @if($professional->adress)
                        <p class="flex items-center gap-2">
                            {{ $professional->adress }}
                        </p>
                        @endif
                        @if($professional->phone)
                        <p class="flex items-center gap-2">
                            {{ $professional->phone }}
                        </p>
                        @endif
                        @if($professional->birthday)
                        <p class="flex items-center gap-2">
                            {{ $professional->birthday }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="flex gap-2">
                <a href="{{ route('professional.edit', $professional->id) }}" class="flex items-center gap-2 px-4 py-2 bg-primary_color text-white rounded-lg hover:bg-primary_color/90 transition-colors">
                    Editar
                </a>
                
                <a href="{{ route('professional.index') }}" 
                   class="flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Tornar
                </a>
            </div>
        </div>

        <div id="box-content" class="relative w-full">
            <div class="flex gap-x-5">
                <button type="button" class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40 active" data-tab="questionnaires"data-url="{{ route('professional.evaluation_form.partial', $professional) }}">
                    Qüestionaris
                </button>

                <button type="button"class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40" data-tab="sumatori"data-url="{{ route('professional.evaluation_form.sum_partial', $professional) }}">
                    Sumatori
                </button>
                
                <a href="#" data-turbo-frame="contenido"class="px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40"> 
                    Formació
                </a>

                <button type="button" class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40"data-tab="questionnaires"data-url="{{ route('professional.followups.partial', $professional) }}"> Seguiment
                </button>
                
                <button type="button"class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40" data-tab="uniformes"data-url="{{ route('professional.uniformes.partial', $professional) }}">
                    Uniformes
                </button>
            </div>

            <!-- CONTENEDOR donde se cargan los partials vía fetch -->
            <div id="tab-container" class="bg-white p-4 rounded shadow-sm z-50"></div>

            <script src="{{ asset('js/professional-tabs.js') }}" defer></script>
        </div>
    </div>
</x-app-layout>