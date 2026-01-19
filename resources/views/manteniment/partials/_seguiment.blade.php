<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white rounded-xl">
    <div class="space-y-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Descripción</h3>
            <div class="bg-gray-50 p-4 rounded-lg">
                @if($manteniment->descripcio)
                    <p class="whitespace-pre-wrap text-gray-700">{{ $manteniment->descripcio }}</p>
                @else
                    <p class="text-gray-400">Sin descripción</p>
                @endif
            </div>
        </div>

        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Información</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Tipo</label>
                    <p class="text-gray-800">{{ $manteniment->tipo === 'manteniment' ? 'Mantenimiento' : 'Seguimiento' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Fecha</label>
                    <p class="text-gray-800">{{ $manteniment->data->format('d/m/Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Responsable</label>
                    <p class="text-gray-800">
                        {{ $manteniment->responsable->name ?? 'No asignado' }}
                        @if($manteniment->responsable && $manteniment->responsable->surname)
                            {{ $manteniment->responsable->surname }}
                        @endif
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Creado</label>
                    <p class="text-gray-800">{{ $manteniment->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Actualizado</label>
                    <p class="text-gray-800">{{ $manteniment->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
