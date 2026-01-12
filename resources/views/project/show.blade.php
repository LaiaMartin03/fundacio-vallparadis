<x-app-layout>
    <div class="px-20 py-10 space-y-4">
        <div class="flex justify-between gap-16 max-w-screen">
            
            {{-- Izquierda --}}
            <div class="flex flex-col gap-2">
                <div class="flex items-center ">
                    <h1 class="font-mclaren text-primary_color text-4xl">{{ $project->name }}</h1> 
                    
                    <a href="{{ route('project.edit', $project->id) }}">
                        <svg fill="currentColor" class="size-5 ml-4 mt-2 text-primary_color fill-current">
                            <use href="#edit"></use>
                        </svg>
                    </a>
                </div>
                <h2 class="font-mclaren text-primary_color text-2xl"> {{ $project->type === 'project' ? 'Projecte' : 'Comissió' }}</h2>
                <h3 class="font-mclaren text-md mt-4 wrap overflow-wrap break-words break-all">{{ $project->description }} </h3>
            
                {{-- Professionals --}}
                <div class="mt-20">
                    <div class="flex items-center text-center mb-3 ">
                        <h3 class="font-mclaren text-primary_color"> Professionals associats </h3>
                        <a href="{{ route('project.addProfessional', $project->id) }}">
                            <svg fill="color-primary_color" class="size-5 ml-2 mt-1 text-primary_color fill-current">
                                <use href="#useradd"></use>
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-4 gap-4 ml-3">
                        @foreach($professionals as $professional)
                            <div class="bg-white p-4 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-64 h-28 items-center">
                                <img class="rounded-full w-20 h-20 object-cover" src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" alt="">
                                <div class="flex flex-col justify-center">
                                    <div class="font-medium"><a href="{{ route('professional.show', $professional->id) }}">{{ $professional->name }} {{ $professional->surname }}</a></div>
                                    <div class="flex items-center justify-between w-full">
                                        <p class="text-sm text-primary_color mb-0 leading-none">Cirujano</p>
                                        <form action="{{ route('project.removeProfessional', [$project->id, $professional->id]) }}" method="POST" class="inline-flex items-center">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ml-2 p-1 border-0 bg-transparent hover:opacity-80 flex items-center" aria-label="Eliminar professional del projecte">
                                                <svg fill="currentColor" class="h-5 w-5 text-primary_color" aria-hidden="true">
                                                    <use href="#userminus"></use>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Derecha --}}
            <div class="flex gap-8 flex-col shrink-0 ">
                {{-- Boton Activar/Desactivar --}}
                <div class="text-center ml-auto">
                    @if (!$project->active)
                        <form action="{{ route('project.activate', $project->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="px-4 py-2 rounded-full text-white bg-green-500">
                                Actiu
                            </button>
                        </form>
                    @else
                        <form action="{{ route('project.destroy', $project->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 rounded-full text-white bg-red-500">
                                Inactiu
                            </button>
                        </form>
                    @endif
                </div>
                
                {{-- Professional responsable --}}
                <div>
                    <p class="font-mclaren text-primary_color mb-3">Professional responsable </p>
                    <div class="py-4 px-6 bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-fit h-fit ml-3">
                        <img class="rounded-full h-12 aspect-square object-cover" src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" alt="">
                        <div class="flex flex-col">
                            <div>{{ $project->professional->name }}</div>
                            <div class="text-sm text-primary_color"> Psicologo </div>
                        </div>
                    </div>
                </div>
                
                {{-- Data --}}
                <div>  
                    <p class="font-mclaren text-primary_color mb-3"> Data</p>
                    <div class="ml-3">
                        <p class="mb-2"><strong>Data d'inici:</strong> {{ $project->start_date }}</p>
                        <p class="mb-2"><strong>Data de finalització:</strong> {{ $project->finish_date ?? 'No especificada' }}</p>
                    </div>
                </div>
                
                {{-- Observacions --}}
                <div>
                    <p class="font-mclaren text-primary_color mb-3">Observacions</p>
                    <div class="ml-3">
                        <p>{{ $project->observations ?? 'No hi ha observacions per aquest projecte.' }}</p>
                    </div>
                </div>
            </div>

        </div>
        
</x-app-layout>