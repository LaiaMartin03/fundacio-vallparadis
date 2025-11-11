<div 
    x-data="{ open: false }" 
    class="relative z-10"
>
    <!-- Botón para abrir -->
    <button 
        @click="open = true"
        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
    >
        Abrir {{ $titulo }}
    </button>

    <!-- Fondo oscuro -->
    <div 
        x-show="open"
        class="fixed inset-0 bg-black/50 flex items-center justify-center"
    >
        <!-- Contenedor del modal -->
        <div 
            @click.outside="open = false"
            class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white rounded-xl"
        >
            <h1 class="text-2xl font-bold mb-4">{{ $titulo }}</h1>

            <!-- Contenido (slot) -->
            {{ $slot }}

            <div class="mt-4 flex justify-end gap-2">
                <button 
                    @click="open = false"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                >
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
