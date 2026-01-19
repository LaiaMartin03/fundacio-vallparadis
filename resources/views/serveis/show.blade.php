<x-app-layout>
    <div class="ml-20 px-20 py-10 space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-2 p-2">
            <h1 class="font-mclaren text-primary_color text-4xl">
                {{ $servei->name }}
            </h1>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $servei->tipus === 'general' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                    {{ $servei->tipus === 'general' ? 'General' : 'Complementari' }}
                </span>
                <span class="text-gray-500 text-sm">
                    Creat el {{ $servei->created_at->format('d/m/Y') }}
                </span>
            </div>
        </div>

        <!-- Descripció -->
        <div class="space-y-2">
            <h2 class="text-lg font-medium text-gray-800">Descripció</h2>
            <div class="bg-white p-4 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] rounded-lg">
                <p class="text-gray-700">{{ $servei->desc ?: 'Sense descripció' }}</p>
            </div>
        </div>

        <!-- Observacions -->
        @if($servei->observacions)
        <div class="space-y-2">
            <h2 class="text-lg font-medium text-gray-800">Observacions</h2>
            <div class="bg-white p-4 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] rounded-lg">
                <p class="text-gray-700">{{ $servei->observacions }}</p>
            </div>
        </div>
        @endif

        <!-- Responsable -->
        @if($servei->user)
        <div class="space-y-2">
            <h2 class="text-lg font-medium text-gray-800">Responsable</h2>
            <div class="bg-white p-4 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] rounded-lg flex gap-5 items-center">
                <div class="flex flex-col justify-center flex-1">
                    <div class="font-medium text-gray-800">
                        {{ $servei->user->name }} {{ $servei->user->surname ?? '' }}
                    </div>
                    <div class="text-sm text-primary_color">
                        {{ $servei->user->email }}
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Document intern -->
        @if($servei->internalDoc)
        <div class="space-y-2">
            <h2 class="text-lg font-medium text-gray-800">Document intern relacionat</h2>
            <div class="bg-white p-4 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] rounded-lg">
                <a href="{{ route('internal-docs.show', $servei->internalDoc->id) }}" 
                   class="text-primary_color hover:text-primary_color/80 font-medium">
                    {{ $servei->internalDoc->title }}
                </a>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex justify-end gap-2">
            <a href="{{ route('serveis.edit', $servei->id) }}" 
               class="px-4 py-2 bg-primary_color text-white rounded-lg hover:bg-primary_color/90 transition-colors">
                Editar
            </a>
            <form action="{{ route('serveis.destroy', $servei->id) }}" method="POST" 
                  onsubmit="return confirm('Estàs segur que vols eliminar aquest servei?');" 
                  class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    Eliminar
                </button>
            </form>
            <a href="{{ route('serveis.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                Tornar
            </a>
        </div>
    </div>
</x-app-layout>
