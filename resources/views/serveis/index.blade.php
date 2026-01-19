<x-app-layout>  
    <div class="px-20 py-10 space-y-10">
        <div id="header" class="flex justify-between items-center">
            <h1 class="font-mclaren text-primary_color text-4xl">Serveis</h1>
            
            <!--<a href="{{ route('professionals.export') }}">
                <x-primary-button>Exportar a Excel</x-primary-button>
            </a>-->
        </div>

        <div class="flex flex-col gap-5">
            <button class="flex gap-4 items-center" onclick="collapseServeis()">
                <span class="text-2xl text-primary_color font-mclaren">Generals</span>
                <div class="h-[1px] bg-primary_color w-full"></div>
            </button>

            <div class="grid grid-rows-auto grid-cols-5 gap-16 transition-all duration-300 ease-in-out" id="section">
            </div>

            <button class="flex gap-4 items-center" onclick="collapseServeis()">
                <span class="text-2xl text-primary_color font-mclaren">Complementaris</span>
                <div class="h-[1px] bg-primary_color w-full"></div>
            </button>

            <x-add-button href="{{ route('serveis.create') }}"></x-add-button>
        </div>
    </div>
</x-app-layout>