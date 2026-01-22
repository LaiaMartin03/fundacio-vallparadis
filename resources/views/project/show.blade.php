<x-app-layout>
    <div class="px-20 py-10 space-y-4">
        <div class="flex justify-between gap-16 max-w-screen">
            
            {{-- Izquierda --}}
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="font-mclaren text-primary_color text-3xl">{{ $project->name }}</h1>
                    <a href="{{ route('project.edit', $project->id) }}" class="flex items-center">
                        <svg class="size-5 text-primary_color hover:opacity-80 transition-opacity">
                            <use href="#edit" />
                        </svg>
                    </a>
                </div>
                
                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $project->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        <span class="w-2 h-2 rounded-full {{ $project->active ? 'bg-green-500' : 'bg-red-500' }} mr-2"></span>
                        {{ $project->active ? 'Actiu' : 'Inactiu' }}
                    </span>
                    
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        {{ $project->type === 'project' ? 'Projecte' : 'Comissió' }}
                    </span>
                </div>
                
                <div class="mt-3">
                    <h3 class="font-mclaren text-lg text-primary_color text-gray-800 mb-2">Descripció</h3>
                    <p class="text-gray-600 wrap overflow-wrap break-words">
                        {{ $project->description }}
                    </p>
                </div>
            
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
                        @forelse($professionals as $professional)
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
                        @empty
                            <div class="col-span-4">
                                <p class="text-center">No n'hi han professionals registrats al projecte <a href="{{ route('project.addProfessional', $project->id) }}" class="text-primary_color">registrals aquí</a></p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Derecha --}}
            <div class="flex gap-8 flex-col shrink-0 ">
                
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