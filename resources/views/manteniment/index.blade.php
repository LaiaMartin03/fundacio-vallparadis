<x-app-layout>  
    <div class="px-20 py-10">
        <div id="header" class="flex justify-between items-center mb-8">
            <h1 class="font-mclaren text-primary_color text-4xl">Manteniment</h1>
        </div>

        <div class="flex gap-5 w-full h-[650px]">
            <div class="flex flex-col gap-12 w-full">
                @if($manteniments->isEmpty())
                    <div class="w-full grid grid-cols-6" id="grid">
                        <p>asd</p>
                    </div>
                @else
                    <p>No hi han manteniments.</p>
                @endif
            </div>
        </div>
    </div>

    <x-add-button href="{{ route('manteniment.create') }}"></x-add-button>
</x-app-layout>
