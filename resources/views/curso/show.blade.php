<x-app-layout>
    @vite('resources/js/programs.js')

    <div class="px-20 pb-10 flex flex-col gap-12">
        <div class="flex justify-between items-center p-2">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="font-mclaren text-primary_color text-3xl">{{ $curso->name }}</h1>
                    <a href="{{ route('curso.edit', $curso->id) }}" class="flex items-center">
                        <svg class="size-5 text-primary_color hover:opacity-80 transition-opacity">
                            <use href="#edit" />
                        </svg>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $curso->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        <span class="w-2 h-2 rounded-full {{ $curso->active ? 'bg-green-500' : 'bg-red-500' }} mr-2"></span>
                        {{ $curso->active ? 'Activo' : 'Inactivo' }}
                    </span>
                    <span class="text-gray-500">
                        {{ $curso->created_at->format('d/m/Y') }}
                    </span>
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
                            @php
                                $user = $program->user;
                            @endphp
                            @if($user)
                                <div data-id="{{ $user->id }}" class="relative py-4 px-6 bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-fit h-fit dragItem" draggable="false">
                                    @if($user->profile_photo_path)
                                        <img class="rounded-full h-12 aspect-square object-cover" src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}">
                                    @else
                                        <div class="rounded-full h-12 aspect-square bg-gray-200 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex flex-col relative">
                                        <div>{{ $user->name }} {{ $user->surname ?? '' }}</div>
                                        <div class="text-sm text-primary_color">{{ $user->role ?? '-' }}</div>
                                    </div>
                                </div>
                            @endif
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
                        @if($usuariosNoInscritos->isEmpty())
                            <p class="text-gray-500">No hi ha més professionals disponibles.</p>
                        @else
                            @foreach($usuariosNoInscritos as $usuario)
                                <div data-id="{{ $usuario->id }}" class="relative py-4 px-6 bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-fit h-fit dragItem" draggable="true">
                                    @if($usuario->profile_photo_path)
                                        <img class="rounded-full h-12 aspect-square object-cover" src="{{ asset('storage/' . $usuario->profile_photo_path) }}" alt="{{ $usuario->name }}">
                                    @else
                                        <div class="rounded-full h-12 aspect-square bg-gray-200 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex flex-col">
                                        <div>{{ $usuario->name }} {{ $usuario->surname ?? '' }}</div>
                                        <div class="text-sm text-primary_color">{{ $usuario->role ?? '-' }}</div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <x-primary-button id="save-changes">Guardar cambios</x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>