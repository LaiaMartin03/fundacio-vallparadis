<x-app-layout>
    <div class="ml-20 px-20 py-10 space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="font-mclaren text-primary_color text-4xl">Temes pendents RRHH</h1>
            <a href="{{ route('hr.create') }}">
                <x-primary-button>Nou Cas</x-primary-button>
            </a>
        </div>
        <!-- Buscador -->
        <div id="filters">
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label for="search-input" class="block text-sm font-medium text-gray-700 mb-2">
                        Cercar per nom
                    </label>
                    <input type="text" id="search-input" placeholder="Escriu el nom del professional..."class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary_color focus:border-transparent">
                </div>
                <button id="clear-search"  class="mt-6 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Netejar
                </button>
            </div>
            <div id="search-results" class="text-sm text-gray-500 mt-2 hidden">
                S'estan mostrant <span id="results-count">0</span> resultats
            </div>
        </div>

        <!-- Lista de casos -->
        <div class="bg-white rounded-lg shadow-sm border">
            @if($pending->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No hi ha casos de RRHH registrats.</p>
                    <a href="{{ route('hr.create') }}" class="text-primary_color hover:underline mt-2 inline-block">
                        Crear el primer cas
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full rounded">
                        <thead class="bg-orange-200 text-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Professional Afectat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Assignat A
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Derivat a
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Descripció
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Documents
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Estat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Data
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pending as $hr)
                                <tr 
                                    class="hover:bg-gray-50 cursor-pointer transition-colors duration-150"
                                    onclick="window.location.href='{{ route('hr.show', $hr->id) }}'"
                                    style="cursor: pointer;"
                                >
                                    <!-- ID -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('hr.show', $hr->id) }}" 
                                           class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 hover:bg-gray-200 transition-colors">
                                            #{{ $hr->id }}
                                        </a>
                                    </td>
                                    
                                    <!-- Professional Afectat -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $hr->affectedProfessional->name ?? 'N/A' }} {{ $hr->affectedProfessional->surname ?? '' }}
                                        </div>
                                    </td>
                                    
                                    <!-- Assignat A -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $hr->assignedTo->name ?? 'N/A' }} {{ $hr->assignedTo->surname ?? '' }}
                                        </div>
                                    </td>
                                    
                                    <!-- Derivat a -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $hr->derivatedTo->name ?? 'N/A' }} {{ $hr->derivatedTo->surname ?? '' }}
                                        </div>
                                    </td>
                                    
                                    <!-- Descripció -->
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            @if($hr->description)
                                                <div class="truncate">{{ $hr->description }}</div>
                                            @else
                                                <span class="text-gray-400 italic">Sense descripció</span>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <!-- Documents -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            @if($hr->attached_docs)
                                                <a href="{{ route('hr.show', $hr->id) }}" 
                                                   class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                    Documents
                                                </a>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <!-- Estat -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('hr.show', $hr->id) }}">
                                            @if($hr->active)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 hover:bg-green-200 transition-colors">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Actiu
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 hover:bg-red-200 transition-colors">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Inactiu
                                                </span>
                                            @endif
                                        </a>
                                    </td>
                                    
                                    <!-- Data -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('hr.show', $hr->id) }}" 
                                           class="hover:text-gray-700 transition-colors">
                                            {{ $hr->created_at->format('d/m/Y') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    
    <script src="{{ asset('js/search.js') }}" defer></script>
</x-app-layout><x-app-layout>
    <div class="ml-20 px-20 py-10 space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="font-mclaren text-primary_color text-4xl">Temes pendents RRHH</h1>
            <a href="{{ route('hr.create') }}">
                <x-primary-button>Nou Cas</x-primary-button>
            </a>
        </div>
        <!-- Buscador -->
        <div id="filters">
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label for="search-input" class="block text-sm font-medium text-gray-700 mb-2">
                        Cercar per nom
                    </label>
                    <input type="text" id="search-input" placeholder="Escriu el nom del professional..."class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary_color focus:border-transparent">
                </div>
                <button id="clear-search"  class="mt-6 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Netejar
                </button>
            </div>
            <div id="search-results" class="text-sm text-gray-500 mt-2 hidden">
                S'estan mostrant <span id="results-count">0</span> resultats
            </div>
        </div>

        <!-- Lista de casos -->
        <div class="bg-white rounded-lg shadow-sm border">
            @if($pending->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No hi ha casos de RRHH registrats.</p>
                    <a href="{{ route('hr.create') }}" class="text-primary_color hover:underline mt-2 inline-block">
                        Crear el primer cas
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full rounded">
                        <thead class="bg-orange-200 text-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Professional Afectat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Assignat A
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Derivat a
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Descripció
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Documents
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Estat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Data
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pending as $datos)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $datos->affectedProfessional->name ?? 'N/A' }} {{ $datos->affectedProfessional->surname ?? '' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $datos->assignedTo->name ?? 'N/A' }} {{ $datos->assignedTo->surname ?? '' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $datos->derivatedTo->name ?? 'N/A' }} {{ $datos->derivatedTo->surname ?? '' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs truncate">
                                            {{ $datos->description ?? 'Sense descripció' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            @if($datos->attached_docs)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Documents
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($datos->active)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Actiu
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Inactiu
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $datos->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <script src="{{ asset('js/search.js') }}" defer></script>
</x-app-layout><x-app-layout>
    <div class="ml-20 px-20 py-10 space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="font-mclaren text-primary_color text-4xl">Temes pendents RRHH</h1>
            <a href="{{ route('hr.create') }}">
                <x-primary-button>Nou Cas</x-primary-button>
            </a>
        </div>
        <!-- Buscador -->
        <div id="filters">
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label for="search-input" class="block text-sm font-medium text-gray-700 mb-2">
                        Cercar per nom
                    </label>
                    <input type="text" id="search-input" placeholder="Escriu el nom del professional..."class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary_color focus:border-transparent">
                </div>
                <button id="clear-search"  class="mt-6 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Netejar
                </button>
            </div>
            <div id="search-results" class="text-sm text-gray-500 mt-2 hidden">
                S'estan mostrant <span id="results-count">0</span> resultats
            </div>
        </div>

        <!-- Lista de casos -->
        <div class="bg-white rounded-lg shadow-sm border">
            @if($pending->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No hi ha casos de RRHH registrats.</p>
                    <a href="{{ route('hr.create') }}" class="text-primary_color hover:underline mt-2 inline-block">
                        Crear el primer cas
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full rounded">
                        <thead class="bg-orange-200 text-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Professional Afectat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Assignat A
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Derivat a
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Descripció
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Documents
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Estat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Data
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pending as $datos)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $datos->affectedProfessional->name ?? 'N/A' }} {{ $datos->affectedProfessional->surname ?? '' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $datos->assignedTo->name ?? 'N/A' }} {{ $datos->assignedTo->surname ?? '' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $datos->derivatedTo->name ?? 'N/A' }} {{ $datos->derivatedTo->surname ?? '' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs truncate">
                                            {{ $datos->description ?? 'Sense descripció' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            @if($datos->attached_docs)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Documents
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($datos->active)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Actiu
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Inactiu
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $datos->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <script src="{{ asset('js/search.js') }}" defer></script>
</x-app-layout><x-app-layout>
    <div class="ml-20 px-20 py-10 space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="font-mclaren text-primary_color text-4xl">Temes pendents RRHH</h1>
            <a href="{{ route('hr.create') }}">
                <x-primary-button>Nou Cas</x-primary-button>
            </a>
        </div>
        <!-- Buscador -->
        <div id="filters">
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label for="search-input" class="block text-sm font-medium text-gray-700 mb-2">
                        Cercar per nom
                    </label>
                    <input type="text" id="search-input" placeholder="Escriu el nom del professional..."class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary_color focus:border-transparent">
                </div>
                <button id="clear-search"  class="mt-6 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Netejar
                </button>
            </div>
            <div id="search-results" class="text-sm text-gray-500 mt-2 hidden">
                S'estan mostrant <span id="results-count">0</span> resultats
            </div>
        </div>

        <!-- Lista de casos -->
        <div class="bg-white rounded-lg shadow-sm border">
            @if($pending->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No hi ha casos de RRHH registrats.</p>
                    <a href="{{ route('hr.create') }}" class="text-primary_color hover:underline mt-2 inline-block">
                        Crear el primer cas
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full rounded">
                        <thead class="bg-orange-200 text-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Professional Afectat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Assignat A
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Derivat a
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Descripció
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Documents
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Estat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Data
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pending as $datos)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $datos->affectedProfessional->name ?? 'N/A' }} {{ $datos->affectedProfessional->surname ?? '' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $datos->assignedTo->name ?? 'N/A' }} {{ $datos->assignedTo->surname ?? '' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $datos->derivatedTo->name ?? 'N/A' }} {{ $datos->derivatedTo->surname ?? '' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs truncate">
                                            {{ $datos->description ?? 'Sense descripció' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            @if($datos->attached_docs)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Documents
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($datos->active)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Actiu
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Inactiu
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $datos->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <script src="{{ asset('js/search.js') }}" defer></script>
</x-app-layout>