<x-app-layout>
    <div class="px-20 pb-10 flex flex-col gap-12">
        <div class="flex justify-between items-start p-2">
            <div class="flex gap-5">
                <x-profile-photo :user="$professional" size="lg" />
                
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-3 mb-2">
                        <h1 class="font-mclaren text-primary_color text-3xl">{{ $professional->name }} {{ $professional->surname }}</h1>
                        <a href="{{ route('professional.edit', $professional->id) }}" class="flex items-center">
                            <svg class="size-5 text-primary_color hover:opacity-80 transition-opacity">
                                <use href="#edit" />
                            </svg>
                        </a>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $professional->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <span class="w-2 h-2 rounded-full {{ $professional->active ? 'bg-green-500' : 'bg-red-500' }} mr-2"></span>
                            {{ $professional->active ? 'Actiu' : 'Inactiu' }}
                        </span>
                        
                        <span class="text-gray-500">
                            Registrat el {{ \Carbon\Carbon::parse($professional->created_at)->format('d/m/Y') }}
                        </span>
                    </div>
                    
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
                        @if($professional->cv_file_path)
                        <p class="flex items-center gap-2 mt-2">
                            <a href="{{ route('professional.cv.download', $professional->id) }}" 
                               class="text-blue-600 hover:underline flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Descargar CV
                            </a>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div id="box-content" class="relative w-full">
            <div class="flex gap-x-5 flex-wrap">
                <button type="button" class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40 active" data-tab="questionnaires"data-url="{{ route('professional.evaluation_form.partial', $professional) }}">
                    Qüestionaris
                </button>

                <button type="button"class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40" data-tab="sumatori"data-url="{{ route('professional.evaluation_form.sum_partial', $professional) }}">
                    Sumatori
                </button>
                
                <a href="#" data-turbo-frame="contenido"class="px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40"> 
                    Formació
                </a>

                <button type="button" class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40"data-tab="seguiment"data-url="{{ route('professional.followups.partial', $professional) }}"> Seguiment
                </button>
                
                <button type="button" class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40" data-tab="uniformes"data-url="{{ route('professional.uniformes.partial', $professional) }}">
                    Uniformes
                </button>

                <button type="button" class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40" data-tab="accidentabilitat" data-url="{{ route('professional.accidentabilitat.partial', $professional) }}">
                    Accidentabilitat
                </button>
            </div>

            <div id="tab-container" class="bg-white p-4 rounded shadow-sm z-50"></div>

            <script src="{{ asset('js/professional-tabs.js') }}" defer></script>
        </div>
    </div>
</x-app-layout>