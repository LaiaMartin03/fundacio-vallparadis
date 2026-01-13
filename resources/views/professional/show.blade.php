<x-app-layout>
    <div class="px-20 pb-10 flex flex-col gap-12">
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
            <div class="flex gap-x-5">
                <button type="button"
                    class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40 active"
                    data-tab="questionnaires"
                    data-url="{{ route('professional.evaluation_form.partial', $professional) }}">
                    Qüestionaris
                </button>

                <button type="button"
                    class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40"
                    data-tab="sumatori"
                    data-url="{{ route('professional.evaluation_form.sum_partial', $professional) }}">
                    Sumatori
                </button>
                <a href="#" 
                   data-turbo-frame="contenido"
                   class="px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40">
                    Formació
                </a>

                <button type="button"
                    class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40"
                    data-tab="questionnaires"
                    data-url="{{ route('professional.followups.partial', $professional) }}">
                    Seguiment
                </button>
                <button type="button"
                    class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40"
                    data-tab="uniformes"
                    data-url="{{ route('professional.uniformes.partial', $professional) }}">
                    Uniformes
                </button>
            </div>


            <!-- CONTENEDOR donde se cargan los partials vía fetch -->
            <div id="tab-container" class=" bg-white p-4 rounded shadow-sm z-50"></div>

            <script src="{{ asset('js/professional-tabs.js') }}" defer></script>
        </div>
    </div>
</x-app-layout>