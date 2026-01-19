<x-app-layout>  
    <div class="px-20 py-10">
        <div id="header" class="flex justify-between items-center mb-8">
            <h1 class="font-mclaren text-primary_color text-4xl">Serveis</h1>
        </div>

        <div class="flex gap-5 w-full">
            <div class="flex flex-col gap-12 w-full">
                <!-- Serveis Generals -->
                <div class="space-y-4">
                    <h2 class="text-2xl text-primary_color font-mclaren">Generals</h2>
                    @if($serveisGenerals->isEmpty())
                        <p class="text-gray-500">No hi ha serveis generals.</p>
                    @else
                        <div class="w-full grid grid-cols-6 gap-4" id="grid-generals">
                            @foreach($serveisGenerals as $servei)
                                <a class="rounded-xl bg-white flex flex-col p-5 w-full shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] gap-3 hover:shadow-[5px_5px_20px_4px_rgba(0,0,0,0.15)] transition-shadow" 
                                   href="{{ route('serveis.show', $servei->id) }}">
                                    <span class="font-medium">{{ $servei->name }}</span>
                                    <div class="h-[1px] bg-primary_color w-full"></div>
                                    <p class="text-gray_color line-clamp-2 text-sm">{{ Str::limit($servei->desc, 80) }}</p>
                                    <span class="text-primary_color mt-2 text-xs">{{ $servei->created_at->format('d/m/Y') }}</span>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Serveis Complementaris -->
                <div class="space-y-4">
                    <h2 class="text-2xl text-primary_color font-mclaren">Complementaris</h2>
                    @if($serveisComplementaris->isEmpty())
                        <p class="text-gray-500">No hi ha serveis complementaris.</p>
                    @else
                        <div class="w-full grid grid-cols-6 gap-4" id="grid-complementaris">
                            @foreach($serveisComplementaris as $servei)
                                <a class="rounded-xl bg-white flex flex-col p-5 w-full shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] gap-3 hover:shadow-[5px_5px_20px_4px_rgba(0,0,0,0.15)] transition-shadow" 
                                   href="{{ route('serveis.show', $servei->id) }}">
                                    <span class="font-medium">{{ $servei->name }}</span>
                                    <div class="h-[1px] bg-primary_color w-full"></div>
                                    <p class="text-gray_color line-clamp-2 text-sm">{{ Str::limit($servei->desc, 80) }}</p>
                                    <span class="text-primary_color mt-2 text-xs">{{ $servei->created_at->format('d/m/Y') }}</span>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-add-button href="{{ route('serveis.create') }}"></x-add-button>
</x-app-layout>
