<x-app-layout>
    <div class="ml-20 px-20 py-10 space-y-6">

        <!-- Header del Caso -->
        <div class="flex justify-between items-center p-2">
            <div>
                <h1 class="font-mclaren text-primary_color text-3xl mb-2">Caso HR #{{ $hr->id }}</h1>
                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $hr->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        <span class="w-2 h-2 rounded-full {{ $hr->active ? 'bg-green-500' : 'bg-red-500' }} mr-2"></span>
                        {{ $hr->active ? 'Activo' : 'Inactivo' }}
                    </span>
                    <span class="text-gray-500">
                        {{ $hr->created_at->format('d/m/Y H:i') }}
                    </span>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('hr.edit', $hr->id) }}" class="px-4 py-2 bg-primary_color text-white rounded-lg hover:bg-primary_color/90 transition-colors">
                    Editar
                </a>
                <a href="{{ route('hr.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Volver
                </a>
            </div>
        </div>

        <!-- Contenido Principal -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Información del Caso -->
            <div class="p-6">
                <h2 class="font-semibold text-xl text-gray-800 mb-4 pb-2 border-b border-primary_color text-primary_color">
                    Informació del cas
                </h2>
                
                <div class="space-y-4">
                    <!-- Profesional Afectado -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Profesional Afectat</label>
                        @if($hr->affectedProfessional)
                        <div class="bg-white p-4 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-full h-28 items-center">
                            <img class="rounded-full w-20 h-20 object-cover" 
                                 src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" 
                                 alt="{{ $hr->affectedProfessional->name }}">
                            <div class="flex flex-col justify-center flex-1">
                                <div class="font-medium">
                                    <a href="{{ route('professional.show', $hr->affectedProfessional->id) }}" class="hover:text-primary_color">
                                        {{ $hr->affectedProfessional->name }} {{ $hr->affectedProfessional->surname }}
                                    </a>
                                </div>
                                <div class="flex items-center justify-between w-full">
                                    <p class="text-sm text-primary_color mb-0 leading-none">
                                        {{ $hr->affectedProfessional->position ?? 'Profesional' }}
                                    </p>
                                </div>
                                @if($hr->affectedProfessional->email)
                                <p class="text-sm text-gray-500 mt-1">{{ $hr->affectedProfessional->email }}</p>
                                @endif
                            </div>
                        </div>
                        @else
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-gray-400">No hi ha profesional afectat</p>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Asignado a -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Asignat a</label>
                        @if($hr->assignedTo)
                        <div class="bg-white p-4 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-full h-28 items-center">
                            <img class="rounded-full w-20 h-20 object-cover" 
                                 src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" 
                                 alt="{{ $hr->assignedTo->name }}">
                            <div class="flex flex-col justify-center flex-1">
                                <div class="font-medium">
                                    <a href="{{ route('professional.show', $hr->assignedTo->id) }}" class="hover:text-primary_color">
                                        {{ $hr->assignedTo->name }} {{ $hr->assignedTo->surname }}
                                    </a>
                                </div>
                                <div class="flex items-center justify-between w-full">
                                    <p class="text-sm text-primary_color mb-0 leading-none">
                                        {{ $hr->assignedTo->position ?? 'Profesional' }}
                                    </p>
                                </div>
                                @if($hr->assignedTo->email)
                                <p class="text-sm text-gray-500 mt-1">{{ $hr->assignedTo->email }}</p>
                                @endif
                            </div>
                        </div>
                        @else
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-gray-400">No hi ha profesional asignat</p>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Derivado a -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Derivat a</label>
                        @if($hr->derivatedTo)
                        <div class="bg-white p-4 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-full h-28 items-center">
                            <img class="rounded-full w-20 h-20 object-cover" 
                                 src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" 
                                 alt="{{ $hr->derivatedTo->name }}">
                            <div class="flex flex-col justify-center flex-1">
                                <div class="font-medium">
                                    <a href="{{ route('professional.show', $hr->derivatedTo->id) }}" class="hover:text-primary_color">
                                        {{ $hr->derivatedTo->name }} {{ $hr->derivatedTo->surname }}
                                    </a>
                                </div>
                                <div class="flex items-center justify-between w-full">
                                    <p class="text-sm text-primary_color mb-0 leading-none">
                                        {{ $hr->derivatedTo->position ?? 'Profesional' }}
                                    </p>
                                </div>
                                @if($hr->derivatedTo->email)
                                <p class="text-sm text-gray-500 mt-1">{{ $hr->derivatedTo->email }}</p>
                                @endif
                            </div>
                        </div>
                        @else
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-gray-400">No hi ha profesional derivat</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Descripción y Documentos -->
            <div class="p-6">
                <h2 class="font-semibold text-xl text-gray-800 mb-4 pb-2 border-b border-primary_color text-primary_color">
                   Detalls
                </h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Descripción</label>
                        <div class="p-4 min-h-[120px]">
                            @if($hr->description)
                                <p class="whitespace-pre-line">{{ $hr->description }}</p>
                            @else
                                <p class="text-gray-400">Sin descripción</p>
                            @endif
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Documentos Adjuntos</label>
                        <div class="p-4">
                            @if($hr->attached_docs)
                                <div class="flex items-center">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $hr->attached_docs }}</p>
                                        <button class="text-primary_color text-sm hover:underline mt-1">
                                            Descargar
                                        </button>
                                    </div>
                                </div>
                            @else
                                <p class="text-gray-400">No hay documentos adjuntos</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECCIÓN DE SEGUIMIENTOS -->
        <div class="mt-8 bg-white rounded-xl shadow-sm p-6">
            <h2 class="font-semibold text-xl text-gray-800 mb-6 pb-2 border-b border-primary_color text-primary_color">
                Seguiments
            </h2>

            {{-- Lista de seguimientos --}}
            <div class="space-y-4 mb-8">
                @if($hr->followups->isEmpty())
                    <p class="text-gray-500 text-center py-4">No hi ha seguiments registrats.</p>
                @else
                    @foreach($hr->followups as $followup)
                        <div class="border rounded-lg p-4 bg-gray-50 hover:bg-gray-100 transition-colors">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex-1">
                                    <div class="font-semibold text-lg text-gray-900">
                                        {{ $followup->topic ?? 'Seguiment #' . $followup->id }}
                                    </div>
                                    <div class="text-sm text-gray-600 mt-1">
                                        <span class="font-medium">{{ $followup->date->format('d/m/Y') }}</span>
                                        @if($followup->registrant)
                                            · Registrat per: {{ $followup->registrant->name }}
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full 
                                        @if($followup->type == 'obert') bg-blue-100 text-blue-800
                                        @elseif($followup->type == 'restringit') bg-yellow-100 text-yellow-800
                                        @elseif($followup->type == 'origen') bg-purple-100 text-purple-800
                                        @elseif($followup->type == 'fi_vinculacio') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ strtoupper($followup->type) }}
                                    </span>
                                    @can('delete', $followup)
                                    <form action="{{ route('hr.followups.destroy', $followup) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Estàs segur que vols eliminar aquest seguiment?')"
                                                class="text-red-600 hover:text-red-800 text-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </div>

                            @if(!empty($followup->description))
                                <div class="mt-3 text-gray-700 whitespace-pre-line bg-white p-3 rounded border">
                                    {{ $followup->description }}
                                </div>
                            @endif

                            @if(!empty($followup->attached_docs))
                                <div class="mt-3">
                                    <span class="text-sm text-gray-600">Arxius adjunts:</span>
                                    <a href="{{ $followup->attached_docs }}" 
                                       target="_blank" 
                                       class="text-primary_color hover:underline text-sm ml-2">
                                        {{ basename($followup->attached_docs) }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- Formulario para añadir seguimiento --}}
            <div class="pt-6 border-t">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Afegeix seguiment</h3>

                <form action="{{ route('hr.followups.store', $hr) }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipus</label>
                            <select name="type" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary_color focus:border-transparent">
                                <option value="seguiment">SEGUIMENT</option>
                                <option value="obert">SEGUIMENT - OBERT</option>
                                <option value="restringit">SEGUIMENT - RESTRINGIT</option>
                                <option value="origen">ORIGEN</option>
                                <option value="fi_vinculacio">FI DE LA VINCULACIÓ</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Data</label>
                            <input type="date" 
                                   name="date" 
                                   value="{{ date('Y-m-d') }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary_color focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tema</label>
                            <input type="text" 
                                   name="topic" 
                                   maxlength="255"
                                   placeholder="Títol del seguiment"
                                   class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary_color focus:border-transparent">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripció</label>
                        <textarea name="description" 
                                  rows="4"
                                  required
                                  placeholder="Descripció detallada del seguiment..."
                                  class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary_color focus:border-transparent"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Documentos adjunts (ruta o URL)</label>
                        <input type="text" 
                               name="attached_docs"
                               placeholder="ex: /documents/hr/seguiment1.pdf"
                               class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary_color focus:border-transparent">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="px-6 py-2 bg-primary_color text-white rounded-lg hover:bg-primary_color/90 transition-colors font-medium">
                            Afegir seguiment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>