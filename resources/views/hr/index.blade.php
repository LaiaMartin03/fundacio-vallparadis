<x-app-layout>  
    <div class="mx-20 px-20 py-10 space-y-4">
        <div id="header" class="flex justify-between items-center mb-12">
            <h1 class="font-mclaren text-primary_color text-4xl mb-4">Temes pendents RRHH</h1>

            <a href="{{ route('hr.create') }}">
                <x-primary-button>Nou Cas</x-primary-button>
            </a>
        </div>

        <!-- Buscador -->
        <div id="filters" class="mb-8">
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label for="search-input" class="block text-sm font-medium text-gray-700 mb-2">
                        Cercar per nom
                    </label>
                    <input type="text" id="search-input" placeholder="Escriu el nom del professional..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary_color focus:border-transparent">
                </div>
                <button id="clear-search" class="mt-6 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Netejar
                </button>
            </div>
            <div id="search-results" class="text-sm text-gray-500 mt-2 hidden">
                S'estan mostrant <span id="results-count">0</span> resultats
            </div>
        </div>

        @if($pending->isEmpty())
            <div class="text-center py-12 bg-white rounded-xl shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">
                <p class="text-gray-500 text-lg mb-4">No hi ha casos de RRHH registrats.</p>
                <a href="{{ route('hr.create') }}" class="text-primary_color hover:underline font-medium">
                    Crear el primer cas
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($pending as $hr)
                    <a class="rounded-xl bg-white flex flex-col p-5 w-full shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] gap-3 hover:shadow-[5px_5px_20px_5px_rgba(0,0,0,0.15)] transition-shadow duration-300 {{ $hr->active == 0 ? 'opacity-60 hover:opacity-80' : '' }}" 
                       href="{{ route('hr.show', $hr->id) }}">
                        
                        <div class="flex justify-between items-start">
                            <span class="font-medium text-lg line-clamp-1">
                                {{ $hr->affectedProfessional->name ?? 'N/A' }} {{ $hr->affectedProfessional->surname ?? '' }}
                            </span>
                            <div class="flex flex-col items-end gap-1">
                                <span class="text-sm text-gray-500">#{{ $hr->id }}</span>
                            </div>
                        </div>
                        
                        <div class="h-[1px] w-full bg-primary_color mb-2 {{ $hr->active == 0 ? 'opacity-50' : '' }}"></div>
                        
                        <div class="text-gray-700 line-clamp-2 text-justify mb-4 flex-1 {{ $hr->active == 0 ? 'opacity-70' : '' }}">
                            @if($hr->description)
                                {{ $hr->description }}
                            @else
                                <span class="text-gray-400 italic">Sense descripció</span>
                            @endif
                        </div>
                        
                        <div class="space-y-3 text-sm {{ $hr->active == 0 ? 'opacity-70' : '' }}">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Assignat a:</span>
                                <span class="font-medium">{{ $hr->assignedTo->name ?? 'N/A' }} {{ $hr->assignedTo->surname ?? '' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Derivat a:</span>
                                <span class="font-medium">{{ $hr->derivatedTo->name ?? 'N/A' }} {{ $hr->derivatedTo->surname ?? '' }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center {{ $hr->active == 0 ? 'opacity-70' : '' }}">
                            <span class="text-primary_color text-sm">
                                {{ $hr->created_at->format('d/m/Y') }}
                            </span>
                            
                            @if($hr->attached_docs)
                                <div class="flex items-center gap-1 text-blue-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span class="text-xs font-medium">Documents</span>
                                </div>
                            @else
                                <span class="text-gray-400 text-xs">Sense documents</span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
        
    </div>
    
    <script src="{{ asset('js/search.js') }}" defer></script>
</x-app-layout>