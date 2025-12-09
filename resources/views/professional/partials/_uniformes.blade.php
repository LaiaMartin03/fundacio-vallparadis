<div>
    @if ($uniformes->isEmpty())
        <div class="flex flex-col items-center justify-center h-64 text-center">
            <p class="text-gray-500 text-lg mb-2">No s'han trobat uniformes</p>
            <p class="text-gray-400 text-sm">Aquest professional no té cap uniforme assignat encara.</p>
        </div>
    @else
         <div class="space-y-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Llista d'Uniformes</h2>
            </div>
            
            @foreach ($uniformes as $uniforme)
                @if($uniforme->id === $newestUniform->id)
                    <span class="bg-primary_color text-white px-2 py-1 rounded-full text-xs font-medium">
                        Més recent
                    </span>
                    <div class="p-4 border-2 border-orange-300 rounded-xl bg-orange-50 shadow-md transform transition-all duration-200">
                        
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <p class="text-gray-700"><strong>Camiseta:</strong> {{ $uniforme->shirt_size ?? 'No especificat' }}</p>
                                <p class="text-gray-700"><strong>Pantaló:</strong> {{ $uniforme->pants_size ?? 'No especificat' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-700"><strong>Sabates:</strong> {{ $uniforme->shoe_size ?? 'No especificat' }}</p>
                                <p class="text-gray-700"><strong>Bata:</strong> 
                                    <span class="font-medium">
                                        {{ $uniforme->lab_coat ? 'Sí' : 'No' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        
                        @if($uniforme->givenBy)
                        <div class="mt-3 pt-3 border-t border-orange-200">
                            <p class="text-sm text-gray-700">
                                <strong>Lliurat per:</strong> 
                                <span class="font-medium">{{ $uniforme->givenBy->name }}</span>
                            </p>
                            <p class="text-sm text-gray-700">
                                <strong>Data:</strong> 
                                {{ $uniforme->delivered_at ? \Carbon\Carbon::parse($uniforme->delivered_at)->format('d/m/Y H:i') : 'Data no especificada' }}
                            </p>
                        </div>
                        @endif
                    </div>
                @else
                    <!-- antiguos -->
                    
                    <div class="p-4 border border-gray-200 rounded-xl bg-gray-50 opacity-60 shadow-sm">

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <p class="text-gray-500"><strong>Camiseta:</strong> {{ $uniforme->shirt_size ?? 'No especificat' }}</p>
                                <p class="text-gray-500"><strong>Pantaló:</strong> {{ $uniforme->pants_size ?? 'No especificat' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500"><strong>Sabates:</strong> {{ $uniforme->shoe_size ?? 'No especificat' }}</p>
                                <p class="text-gray-500"><strong>Bata:</strong> 
                                    <span class="font-medium opacity-80">
                                        {{ $uniforme->lab_coat ? 'Sí' : 'No' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        
                        @if($uniforme->givenBy)
                        <div class="mt-3 pt-3 border-t border-gray-200">
                            <p class="text-sm text-gray-500">
                                <strong>Lliurat per:</strong> 
                                <span class="font-medium opacity-80">{{ $uniforme->givenBy->name }}</span>
                            </p>
                            <p class="text-sm text-gray-500">
                                <strong>Data:</strong> 
                                {{ $uniforme->delivered_at ? \Carbon\Carbon::parse($uniforme->delivered_at)->format('d/m/Y H:i') : 'Data no especificada' }}
                            </p>
                        </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>