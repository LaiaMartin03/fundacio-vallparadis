<x-app-layout>
    <div class="ml-20 px-20 pb-10 flex flex-col gap-12">
        <div class="flex gap-20 w-full" id="info">
            <img class="rounded-full w-[200px] aspect-square object-cover" 
            src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?auto=format&q=80&w=300" 
            alt="{{ $professional->name }}">
            
            <div id="details" class="flex flex-col gap-5 w-full">
                <div class="flex items-center gap-5 items-center">
                    <h1 class="font-mclaren text-primary_color text-4xl">{{ $professional->name }} {{ $professional->surname }}</h1>

                    <a href="{{ route('professional.edit', $professional->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5" 
                        stroke="#FF7400" 
                        class="size-6">
                        
                        <path stroke-linecap="round" 
                        stroke-linejoin="round" 
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </a>
                    <div class="text-center ml-auto">
                        @if (!$professional->active)
                            <form action="{{ route('professional.activate', $professional->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-4 py-2 rounded-full text-white bg-green-500">
                                    Actiu
                                </button>
                            </form>
                        @else
                            <form action="{{ route('professional.destroy', $professional->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 rounded-full text-white bg-red-500">
                                    Inactiu
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div>
                    <p class="text-gray-600 mt-2">{{ $professional->email }}</p>
                    <p class="text-gray-600 mt-2">{{ $professional->adress }}</p>
                    <p class="text-gray-600 mt-2">{{ $professional->phone }}</p>
                    <p class="text-gray-600 mt-2">{{ $professional->birthday }}</p>
                </div>
            </div>
        </div>

        <div id="box-content" class="relative w-full">
            <div class="flex gap-5">
                <button class="px-3 py-1 text-primary_color rounded-t-lg bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">Qüestionaris</button>
                <div class="px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40">Formació</div>
                <div class="px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40">Evaluació</div>
            </div>
            <div class="absolute top-0 w-full">
                <div class="flex gap-5">
                    <button class="px-3 py-1 text-primary_color rounded-t-lg bg-white">Qüestionaris</button>
                    <button class="px-3 py-1 text-white  opacity-0">Formació</button>
                    <button class="px-3 py-1 text-white  opacity-0">Evaluació</button>
                </div>
                <div class="h-[500px] bg-white rounded-tr-lg rounded-br-lg rounded-bl-lg w-full p-12 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">
                    hola
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
