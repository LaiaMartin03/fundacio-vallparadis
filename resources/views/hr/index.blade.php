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