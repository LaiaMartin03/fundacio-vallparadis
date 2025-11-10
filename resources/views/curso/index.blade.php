<x-app-layout>  
    <div class="mx-20 px-20 py-10 space-y-4">
        <div id="header" class="flex justify-between items-center">
            <h1 class="font-mclaren text-primary_color text-4xl mb-4">Cursos</h1>
        </div>

        @if($cursos->isEmpty())
            <p>Ni hi han cursos registrats.</p>
        @else
            <div clasS="grid grid-cols-5 grid-rows-auto gap-16">
                @foreach($cursos as $curso)
                    <a class="rounded-xl bg-white flex flex-col p-5 w-full shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] gap-3" href="{{ route('curso.show', $curso->id) }}">
                        <span class="font-medium line-clamp-1">{{ $curso->name }}</span>
                        <div class="h-[1px] w-full bg-primary_color mb-2"></div>
                        <span class="text-gray-700 line-clamp-2 text-justify">{{ $curso->info }}</span>
                        
                        <div class="mt-auto flex justify-between items-end">
                            <span class="text-primary_color text-sm">{{ formatHours($curso->hours) }}</span>

                            <div class="flex relative">
                                <div class="rounded-full overflow-hidden aspect-square w-8 flex items-center justify-center">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/de/Alfonso_Ribeiro.JPG" alt="">
                                </div>

                                <div class="rounded-full overflow-hidden aspect-square w-8 flex items-center justify-center -ml-4">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/de/Alfonso_Ribeiro.JPG" alt="">
                                </div>

                                <div class="rounded-full overflow-hidden aspect-square w-8 flex items-center justify-center -ml-4">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/de/Alfonso_Ribeiro.JPG" alt="">
                                </div>

                                <div class="rounded-full aspect-square w-8 flex items-center justify-center -ml-4 bg-charcoal_color">
                                    <span class="text-white text-xs font-bold">10+ {{ $learningProgram }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
