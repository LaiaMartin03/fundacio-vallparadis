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
                <a href="{{ route('professional.show', $professional) }}" 
                   data-turbo-frame="contenido"
                   class="px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40">
                    Qüestionaris
                </a>
                <a href="#" 
                   data-turbo-frame="contenido"
                   class="px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40">
                    Formació
                </a>
                <a href="#" 
                   data-turbo-frame="contenido"
                   class="px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40">
                    Evaluació
                </a>
                <a href="{{ route('professional.uniformes', $professional) }}" 
                   data-turbo-frame="contenido"
                   class="px-3 py-1 text-primary_color rounded-t-lg bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">
                    Uniformes
                </a>
            </div>

            {{-- Turbo Frame --}}
            <turbo-frame id="contenido" src="{{ route('professional.uniformes', $professional) }}" target="_top">
                <div class="h-[500px] bg-white rounded-lg p-12 shadow flex items-center justify-center">
                    <div class="text-center">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary_color mx-auto mb-4"></div>
                        <p class="text-gray-500">Carregant uniformes...</p>
                    </div>
                </div>
            </turbo-frame>
        </div>
    </div>
</x-app-layout>