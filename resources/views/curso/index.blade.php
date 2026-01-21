<x-app-layout>  
    <div class="px-20 py-10 space-y-4">
        <div id="header" class="flex justify-between items-center mb-4">
            <h1 class="font-mclaren text-primary_color text-4xl mb-4">Cursos</h1>

            <a href="{{ route('curso.export') }}">
                <x-primary-button>Exportar a Excel</x-primary-button>
            </a>
        </div>

        <div class="pb-8">
            <x-buscador 
            label="Cercar cursos" 
            placeholder="Escriu el nom o descripció del curs..." 
            />
        </div>

        @if($cursos->isEmpty())
            <p>Ni hi han cursos registrats.</p>
        @else
            <div class="grid grid-cols-5 grid-rows-auto gap-16" id="cursos-grid">
                @foreach($cursos as $curso)
                    <a class="rounded-xl bg-white flex flex-col p-5 w-full shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] gap-3" href="{{ route('curso.show', $curso->id) }}">
                        <span class="font-medium line-clamp-1">{{ $curso->name }}</span>
                        <div class="h-[1px] w-full bg-primary_color mb-2"></div>
                        <span class="text-gray-700 line-clamp-2 text-justify">{{ $curso->info }}</span>
                        
                        <div class="mt-auto flex justify-between items-end">
                            <span class="text-primary_color text-sm">{{ formatHours($curso->hours) }}</span>

                            <!--<div class="flex relative">
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
                                    <span class="text-white text-xs font-bold">10+</span>
                            </div>
                                </div>-->
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        <x-add-button href="{{ route('curso.create') }}"></x-add-button>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-input');
                const grid = document.getElementById('cursos-grid');
                
                if (!searchInput || !grid) return;
                
                const cards = Array.from(grid.querySelectorAll('a'));
                
                searchInput.addEventListener('input', function() {
                    const term = this.value.trim().toLowerCase();
                    
                    cards.forEach(card => {
                        const text = card.textContent.toLowerCase();
                        card.style.display = text.includes(term) ? '' : 'none';
                    });
                });
            });
        </script>
    </div>
</x-app-layout>
