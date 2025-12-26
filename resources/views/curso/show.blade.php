<x-app-layout>
    @vite('resources/js/programs.js')

    <div class="ml-20 px-20 pb-10 flex flex-col gap-12">
        <div class="flex gap-20 w-full" id="info">
            <div id="details" class="flex flex-col gap-5 w-full">
                <div class="flex items-center gap-5 items-center">
                    <h1 class="font-mclaren text-primary_color text-4xl">{{ $curso->name }}</h1>

                    <a href="{{ route('curso.edit', $curso->id) }}">
                        <svg class="size-5 text-primary_color">
                            <use href="#edit"></use>
                        </svg>
                    </a>
                </div>

                <div>
                    <p class="text-gray-600 mt-2">{{ $curso->info }}</p>
                </div>
            </div>
        </div>

        <div class="flex w-full justify-between">
            <div class="flex flex-col gap-16">
                <div class="flex gap-4">
                    <p class="bg-white rounded-lg text-primary_color px-3 py-1 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">
                        {{ $curso->type }}
                    </p>
                    <!--<p class="bg-white rounded-lg text-primary_color px-3 py-1 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">
                        {{ $curso->modality }}
                    </p>-->
                    <p class="bg-white rounded-lg text-primary_color px-3 py-1 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">
                        {{ formatHours($curso->hours) }}
                    </p>
                </div>
            
                <div id="dropZone" data-course-id="{{ $curso->id }}" class="h-full grid grid-cols-4 grid-rows-auto gap-4 rounded-lg relative p-4 border border-transparent">
                    <div class="pointer-events-none bg-black opacity-25 flex justify-center items-center absolute w-full h-full text-white font-bold rounded-lg hidden" id="dropEffect">Drop Here</div>

                    @if($learningProgram->isEmpty())
                        <p id="no-professionals">No hi ha professionals registrats.</p>
                    @else
                        @foreach($learningProgram as $program)
                            <div data-id="4" class="relative py-4 px-6 bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-fit h-fit dragItem" draggable="true">
                                <img class="rounded-full h-12 aspect-square object-cover" src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" alt="">
                                <div class="flex flex-col">
                                    <div>Antonio Lobato</div>
                                    <div class="text-sm text-primary_color">Psicólogo</div>
                                </div>
                                <button class="text-gray-300 hover:text-gray-500 cursor-pointer absolute bottom-2 right-4 hidden" id="take-out">X</button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-l-lg flex p-8 w-fit gap-12 h-[640px] -mr-20">
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
                        @foreach($learningProgram as $program)
                            <div data-id="4" class="relative py-4 px-6 bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-fit h-fit dragItem" draggable="true">
                                <img class="rounded-full h-12 aspect-square object-cover" src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" alt="">
                                <div class="flex flex-col">
                                    <div>Antonio Lobato</div>
                                    <div class="text-sm text-primary_color">Psicólogo</div>
                                </div>
                            </div>
                        @endforeach
                        <div data-id="2" class="relative py-4 px-6 bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-fit h-fit dragItem" draggable="true">
                            <img class="rounded-full h-12 aspect-square object-cover" src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" alt="">
                            <div class="flex flex-col">
                                <div>Antonio Lobato</div>
                                <div class="text-sm text-primary_color">Psicólogo</div>
                            </div>
                        </div>

                        <div data-id="3" class="relative py-4 px-6 bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-fit h-fit dragItem" draggable="true">
                            <img class="rounded-full h-12 aspect-square object-cover" src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" alt="">
                            <div class="flex flex-col">
                                <div>Antonio Lobato</div>
                                <div class="text-sm text-primary_color">Psicólogo</div>
                            </div>
                        </div>
                    </div>

                    <x-primary-button id="save-changes">Guardar cambios</x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>