<x-app-layout class="container border">  
    <div class="mx-20 px-20 py-10 space-y-10">
        <div id="header" class="flex justify-between items-center">

            <h1 class="font-mclaren text-primary_color text-4xl">Professionals</h1>
            
            <a href="{{ route('professionals.export') }}">
                <x-primary-button> Exportar a Excel</x-primary-button>
            </a>
        </div>

        <div id="filters" class="p-5 border"></div>

        <div class="flex flex-col gap-5">
            <button class="flex gap-4 items-center" onclick="collapseProfesionals()">
                <span class="text-2xl text-primary_color font-mclaren">Psicòlegs</span>
                <div class="h-[1px] bg-primary_color w-full"></div>
            </button>

            <div class="grid grid-rows-auto grid-cols-5 gap-16" id="section">                
                @if($professionals->isEmpty())
                    <p>No hi ha professionals registrats.</p>
                @else
                    @foreach($professionals as $professional)
                        <div class="items-center w-fit bg-white py-5 px-8 rounded-xl flex flex-col">
                            <img class="rounded-full w-40 m-auto aspect-square object-cover" src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" alt="">
                            <span class="mt-5 text-lg">{{ $professional->name }}</span>
                            <span class="text-primary_color text-sm">Psícologo</span>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>  