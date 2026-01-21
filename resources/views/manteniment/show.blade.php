<x-app-layout>
    <div class="ml-20 px-20 py-10 space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-2 p-2">
            <div class="flex items-center gap-3">
                <h1 class="font-mclaren text-primary_color text-4xl">
                    {{ $manteniment->tipo === 'manteniment' ? 'Mantenimiento' : 'Seguimiento' }}
                </h1>
                <a href="{{ route('manteniment.edit', $manteniment->id) }}" class="flex items-center">
                    <svg class="size-5 text-primary_color hover:opacity-80 transition-opacity">
                        <use href="#edit" />
                    </svg>
                </a>
            </div>
            <div class="flex flex-col gap-1 text-gray-600">
                <p class="text-lg">{{ $manteniment->descripcio ? Str::limit($manteniment->descripcio, 100) : 'Sin descripción' }}</p>
                <p class="text-base">{{ $manteniment->data->format('d/m/Y') }}</p>
            </div>
        </div>

        <!-- Professional Afectat (Responsable) -->
        <div class="space-y-2">
            <h2 class="text-lg font-medium text-gray-800">Professional Afectat</h2>
            @if($manteniment->responsable)
                <div class="bg-white p-4 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-full items-center">
                    <img class="rounded-full w-20 h-20 object-cover" 
                         src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" 
                         alt="{{ $manteniment->responsable->name }}">
                    <div class="flex flex-col justify-center flex-1">
                        <div class="font-medium text-gray-800">
                            {{ $manteniment->responsable->name }} {{ $manteniment->responsable->surname ?? '' }}
                        </div>
                        <div class="text-sm text-primary_color">
                            {{ $manteniment->responsable->role ?? 'Profesional' }}
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white p-4 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] rounded-lg text-center text-gray-400">
                    No hay responsable asignado
                </div>
            @endif
        </div>

        <!-- Tabs -->
        <div id="box-content" class="relative w-full">
            <div class="flex gap-x-5">
                <button type="button" 
                        class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40 active" 
                        data-tab="seguiment"
                        data-url="{{ route('manteniment.seguiment.partial', $manteniment) }}">
                    Seguiment
                </button>
                <button type="button" 
                        class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40" 
                        data-tab="documents"
                        data-url="{{ route('manteniment.documents.partial', $manteniment) }}">
                    Documents
                </button>
            </div>

            <!-- CONTENEDOR donde se cargan los partials vía fetch -->
            <div id="tab-container" class="bg-white p-4 rounded shadow-sm z-50"></div>

            <script src="{{ asset('js/professional-tabs.js') }}" defer></script>
        </div>
    </div>
</x-app-layout>
