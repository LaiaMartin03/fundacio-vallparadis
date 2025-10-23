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
                        <svg class="size-5 text-primary_color">
                            <use href="#edit"></use>
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
