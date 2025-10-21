<x-app-layout class="container border">  
    <div class="mx-20 px-20 py-10">
        <h1 class="font-mclaren text-primary">Professionals</h1>

        <div class="grid grid-rows-auto grid-cols-5 gap-16">
            @if($professionals->isEmpty())
            <p>No hi ha professionals registrats.</p>
            @else
            
            @foreach($professionals as $professional)
                <a href="{{ route('professional.edit', $professional->id)}}">
                    <div class="items-center w-fit bg-white py-5 px-8 rounded-xl flex flex-col">
                    <img class="rounded-full w-40 m-auto aspect-square object-cover" src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" alt="">
                    <span class="mt-5">{{ $professional->name }}</span>
                    <span class="text-primary">Psícologo</span>
                    </div>
                </a>
            @endforeach
            
            <a href="{{ route('professionals.export') }}">
                <x-primary-button> Exportar a Excel</x-primary-button>
            </a>
            @endif
        </div>
    </div>
</x-app-layout>  