<x-app-layout>
    @vite('resources/js/programs.js')

    <div class="ml-20 px-20 pb-10 flex flex-col gap-12">
        <div class="flex gap-20 w-full" id="info">
            <div id="details" class="flex flex-col gap-5 w-full">
                <div class="flex items-center gap-5 items-center">
                    <h1 class="font-mclaren text-primary_color text-4xl">Nombre del curso</h1>

                    <a href="/">
                        <svg class="size-5 text-primary_color">
                            <use href="#edit"></use>
                        </svg>
                    </a>
                </div>

                <div>
                    <p class="text-gray-600 mt-2">Esto supongo que es la descripción.</p>
                </div>
            </div>
        </div>

        <div class="flex w-full justify-between">
            <div class="flex flex-col gap-16">
                <div class="flex gap-4">
                    <p class="bg-white rounded-lg text-primary_color px-3 py-1 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">
                        Tipo
                    </p>
                    <p class="bg-white rounded-lg text-primary_color px-3 py-1 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">
                        Modalidad
                    </p>
                    <p class="bg-white rounded-lg text-primary_color px-3 py-1 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">
                        1h 43min
                    </p>
                </div>
            
                <div id="dropZone" class="h-full grid grid-cols-4 grid-rows-auto gap-4 rounded-lg relative p-5 p-4 border-transparent border">
                    <div class="pointer-events-none bg-black opacity-25 flex justify-center items-center absolute w-full h-full text-white font-bold rounded-lg hidden" id="dropEffect">Drop Here</div>

                    @if($learning_program->isEmpty())
                        <p>No hi ha professionals registrats.</p>
                    @else
                        @foreach($learning_program as $program)
                            <div class="py-4 px-6 bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-fit h-fit">
                                <img class="rounded-full h-12 aspect-square object-cover" src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" alt="">
                                <div class="flex flex-col">
                                    <div>Antonio Lobato</div>
                                    <div class="text-sm text-primary_color">Psicólogo</div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-l-lg flex p-8 w-fit gap-12 h-[640px]">
                <button class="flex gap-10 [writing-mode:vertical-rl] rotate-180 justify-center" id="assignUsers">
                    <svg class="size-5 rotate-180 arrowButton">
                        <use href="#double_arrow" />
                    </svg>
                    <span>Afegir professionals</span>
                    <svg class="size-5 rotate-180 arrowButton">
                        <use href="#double_arrow" />
                    </svg>
                </button>

                <div class="flex flex-col gap-8 h-[575px] hidden" id="usersZone">
                    <x-text-input id="name" name="name" type="text" placeholder="Nom" class="mt-1 block w-full" :value="old('name')" />

                    <div class="flex flex-col gap-4 pr-4 py-2 overflow-y-scroll h-full">
                        <div class="py-4 px-6 bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-fit h-fit dragItem" draggable="true">
                            <img class="rounded-full h-12 aspect-square object-cover" src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" alt="">
                            <div class="flex flex-col">
                                <div>Antonio Lobato</div>
                                <div class="text-sm text-primary_color">Psicólogo</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>