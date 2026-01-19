<x-app-layout>  
    <div class="px-20 py-10">
        <div id="header" class="flex justify-between items-center mb-8">
            <h1 class="font-mclaren text-primary_color text-4xl">Manteniment</h1>
        </div>

        <div class="flex gap-5 w-full h-[650px]">
            <div class="flex flex-col gap-12 w-full">
                @if($manteniments->isEmpty())
                    <p>No hi han manteniments.</p>
                @else
                    <div class="w-full grid grid-cols-6" id="grid">
                        <a class="rounded-xl bg-white flex flex-col p-5 w-full shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] gap-3" href="{{ route('manteniments.show', $manteniments->id) }}">
                            <span class="font-medium">Title</span>
                            <div class="h-[1px] bg-primary_color w-full"></div>
                            <p class="text-gray_color">Descripcion</p>
                            <span class="text-primary_color mt-5 text-sm">20/12/2025</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <x-add-button href="{{ route('manteniment.create') }}"></x-add-button>
</x-app-layout>
