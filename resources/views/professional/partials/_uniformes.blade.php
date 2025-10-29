<div class="h-[500px] bg-white rounded-lg p-6 shadow overflow-y-auto">
    <!-- Debug visible -->
    <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-blue-800 font-medium">Debug Info:</p>
        <p class="text-blue-600 text-sm">Professional ID: {{ $professional->id }}</p>
        <p class="text-blue-600 text-sm">Uniformes encontrados: {{ $uniformes->count() }}</p>
        <p class="text-blue-600 text-sm">Timestamp: {{ now() }}</p>
    </div>

    @if ($uniformes->isEmpty())
        <div class="flex flex-col items-center justify-center h-64 text-center">
            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <p class="text-gray-500 text-lg mb-2">No s'han trobat uniformes</p>
            <p class="text-gray-400 text-sm">Aquest professional no té cap uniforme assignat encara.</p>
        </div>
    @else
        <div class="space-y-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Llista d'Uniformes</h2>
                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                    {{ $uniformes->count() }} uniforme(s)
                </span>
            </div>
            
            @foreach ($uniformes as $uniforme)
                <div class="p-4 border border-gray-200 rounded-xl bg-white shadow-sm">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="font-semibold text-lg text-gray-800">Uniforme #{{ $uniforme->id }}</h3>
                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
                            ID: {{ $uniforme->id }}
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-gray-600"><strong>Camiseta:</strong> {{ $uniforme->shirt_size ?? 'No especificat' }}</p>
                            <p class="text-gray-600"><strong>Pantaló:</strong> {{ $uniforme->pants_size ?? 'No especificat' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600"><strong>Sabates:</strong> {{ $uniforme->shoe_size ?? 'No especificat' }}</p>
                            <p class="text-gray-600"><strong>Bata:</strong> 
                                <span class="{{ $uniforme->lab_coat ? 'text-green-600' : 'text-red-600' }} font-medium">
                                    {{ $uniforme->lab_coat ? 'Sí' : 'No' }}
                                </span>
                            </p>
                        </div>
                    </div>
                    
                    @if($uniforme->givenBy)
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <p class="text-sm text-gray-600">
                            <strong>Lliurat per:</strong> 
                            <span class="text-blue-600 font-medium">{{ $uniforme->givenBy->name }}</span>
                        </p>
                        <p class="text-sm text-gray-600">
                            <strong>Data:</strong> 
                            {{ $uniforme->delivered_at ? $uniforme->delivered_at->format('d/m/Y H:i') : 'Data no especificada' }}
                        </p>
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>