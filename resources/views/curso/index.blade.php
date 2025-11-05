<x-app-layout>  
    <div class="mx-20 px-20 py-10 space-y-4">
        <div id="header" class="flex justify-between items-center">
            <h1 class="font-mclaren text-primary_color text-4xl">Cursos</h1>
        </div>

        @if($cursos->isEmpty())
            <p>Ni hi han cursos registrats.</p>
        @else
            @foreach($cursos as $curso)
                <div class="rounded-lg bg-white flex flex-col p-3 w-fit">
                    <span class="font-medium">{{ $curso->name }}</span>
                    <div class="h-[1px] w-full bg-primary_color mt-1 mb-2"></div>
                    <span class="text-gray-700">{{ $curso->info }}</span>

                    <div>
                        <span>{{ $curso->hours }}</span>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
