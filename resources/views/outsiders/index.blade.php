<x-app-layout>  
    <div class="px-20 py-10 space-y-4">
        <div id="header" class="flex justify-between items-center mb-12">
            <h1 class="font-mclaren text-primary_color text-4xl mb-4">Contactes externs</h1>
        </div>

        <div>
            <x-toggle slot1="Serveis generals" slot2="Assistencials"/>
        </div>

        @if($outsiders->isEmpty())
            <p>Ni hi han contactes registrats.</p>

            <div class="rounded-xl bg-white flex flex-col p-5 w-fit shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">
                <div class="mb-3 gap-16 flex items-center">
                    <span>Antonia Lopez</span>
                    <button class="">
                        <svg class="size-5 text-gray-300">
                            <use href="#new-tab" />
                        </svg>
                    </button>
                </div>
                <span>antonia@gmail.com</span>
                <span class="mb-3">666 66 66 66</span>
                <span class="text-sm text-primary_color text-right">Limpieza</span>
            </div>
        @else
            <div class="grid grid-cols-5 grid-rows-auto gap-16">
                @foreach($outsiders as $outsider)
                    <div class="rounded-xl bg-white flex flex-col p-5 w-fit shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] gap-3">
                        <span>Antonia Lopez</span>
                        <a class="" href="{{ route('outsider.show', $outsider->id) }}">
                            <svg class="size-5 text-gray-300">
                                <use href="#new-tab" />
                            </svg>
                        </a>
                        <span>antonia@gmail.com</span>
                        <span>666 66 66 66</span>
                        <span>Limpieza</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
