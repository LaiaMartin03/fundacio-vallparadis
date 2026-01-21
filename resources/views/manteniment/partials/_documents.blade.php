<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white rounded-xl">
    <div class="space-y-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Documentos adjuntos</h3>
        @if($manteniment->docs_adjunts && count($manteniment->docs_adjunts) > 0)
            <div class="space-y-3">
                @foreach($manteniment->docs_adjunts as $doc)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div>
                                <p class="font-medium text-gray-800">{{ basename($doc) }}</p>
                                <p class="text-sm text-gray-500">Documento adjunto</p>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $doc) }}" 
                           target="_blank" 
                           class="px-4 py-2 bg-primary_color text-white rounded-lg hover:bg-primary_color/90 transition-colors text-sm font-medium">
                            Ver documento
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="text-gray-400 text-lg">No hay documentos adjuntos</p>
            </div>
        @endif
    </div>
</div>
