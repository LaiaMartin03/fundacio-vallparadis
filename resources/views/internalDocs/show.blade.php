<x-app-layout>
    <div class="px-20 py-10 space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center p-2">
            <div>
                <h1 class="font-mclaren text-primary_color text-3xl mb-2">{{ $internalDoc->title }}</h1>
                <div class="flex items-center gap-4">
                    @if($internalDoc->type)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $internalDoc->type }}
                        </span>
                    @endif
                    <span class="text-gray-500">
                        {{ $internalDoc->created_at->format('d/m/Y H:i') }}
                    </span>
                    @if($internalDoc->addedBy)
                        <span class="text-gray-500">
                            Afegit per: {{ $internalDoc->addedBy->name }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="flex gap-2">
                @if($internalDoc->file_path)
                    <a href="{{ route('internal-docs.download', $internalDoc->id) }}" 
                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Descarregar
                    </a>
                @endif
                <a href="{{ route('internal-docs.edit', $internalDoc->id) }}" 
                   class="px-4 py-2 bg-primary_color text-white rounded-lg hover:bg-primary_color/90 transition-colors">
                    Editar
                </a>
                <form action="{{ route('internal-docs.destroy', $internalDoc->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors"
                            onclick="return confirm('Estàs segur que vols eliminar aquest document?')">
                        Eliminar
                    </button>
                </form>
                <a href="{{ route('internal-docs.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Tornar
                </a>
            </div>
        </div>

        <!-- Contenido Principal -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Información del Documento -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="font-semibold text-xl text-gray-800 mb-4 pb-2 border-b border-primary_color text-primary_color">
                    Informació del document
                </h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Títol</label>
                        <p class="bg-gray-50 p-3 rounded-lg">{{ $internalDoc->title }}</p>
                    </div>

                    @if($internalDoc->desc)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Descripció</label>
                        <p class="bg-gray-50 p-3 rounded-lg whitespace-pre-wrap">{{ $internalDoc->desc }}</p>
                    </div>
                    @endif

                    @if($internalDoc->type)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Tipus</label>
                        <p class="bg-gray-50 p-3 rounded-lg">{{ $internalDoc->type }}</p>
                    </div>
                    @endif

                    @if($internalDoc->file_path)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Fitxer</label>
                        <div class="bg-gray-50 p-3 rounded-lg flex items-center justify-between">
                            <span class="text-gray-700">{{ $internalDoc->display_filename }}</span>
                            <a href="{{ route('internal-docs.download', $internalDoc->id) }}" 
                               class="text-primary_color hover:underline flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Descarregar
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Información Adicional -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="font-semibold text-xl text-gray-800 mb-4 pb-2 border-b border-primary_color text-primary_color">
                    Informació addicional
                </h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Data de creació</label>
                        <p class="bg-gray-50 p-3 rounded-lg">{{ $internalDoc->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Última actualització</label>
                        <p class="bg-gray-50 p-3 rounded-lg">{{ $internalDoc->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                    @if($internalDoc->addedBy)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Afegit per</label>
                        <p class="bg-gray-50 p-3 rounded-lg">{{ $internalDoc->addedBy->name }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
