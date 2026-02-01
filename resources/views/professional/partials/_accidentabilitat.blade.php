@if(auth()->user()->role === 'Equip Directiu' || auth()->user()->role === 'Administració' || auth()->user()->role === 'Responsable/Equip Tecnic')
<div class="space-y-6">
    <!-- Fitxa -->
    <div class="space-y-4">
        <div class="flex justify-between items-center cursor-pointer" onclick="toggleCollapse('fitxaSection')">
            <h3 class="text-lg font-semibold text-gray-900">Fitxa d'Accidentabilitat</h3>
            <div class="flex items-center space-x-2">
                <x-primary-button>
                    Descarregar Fitxa
                </x-primary-button>

                <x-primary-button  onclick="event.stopPropagation(); toggleInlineForm('pujarFitxaInlineForm')">
                    Pujar Fitxa
                </x-primary-button>

                <svg id="fitxaSectionToggle" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </div>
        <div id="fitxaSection" class="bg-gray-50 p-4 rounded hidden">
            <p class="text-gray-500">Fitxa d'accidentabilitat imprimible.</p>
        </div>

        <div id="pujarFitxaInlineForm" class="mt-3 hidden">
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4 bg-white p-4 rounded border">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fitxer</label>
                        <input type="file" name="fitxer" class="mt-1 block w-full" required>
                    </div>
                    <div class="flex justify-end space-x-2 mt-4">                        
                        <x-primary-button onclick="toggleInlineForm('pujarFitxaInlineForm')" class="bg-gray-400 text-gray-700 px-4 py-2 rounded-xl border-gray-300 hover:text-black ">
                            Cancel·lar
                        </x-primary-button>
                        <x-primary-button>
                            Pujar
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Accident de Treball Sense Baixa -->
    <div class="space-y-4">
        <div class="flex justify-between items-center cursor-pointer" onclick="toggleCollapse('senseBaixaSection')">
            <h3 class="text-lg font-semibold text-gray-900">Accident de Treball Sense Baixa</h3>
            <div class="flex items-center space-x-2">
                <x-primary-button onclick="event.stopPropagation(); toggleInlineForm('accidentSenseBaixaInlineForm')">
                    Afegir Accident
                </x-primary-button>

                <svg id="senseBaixaSectionToggle" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </div>

        <div id="senseBaixaSection" class="bg-gray-50 p-4 rounded hidden">
            @if($accidents->where('type', 'sense_baixa')->isEmpty())
                <p class="text-gray-500">No hi ha accidents sense baixa registrats.</p>
            @else
                <div class="space-y-3">
                    @foreach($accidents->where('type', 'sense_baixa') as $accident)
                        <div class="bg-white p-3 rounded border">
                            <p class="font-medium">{{ $accident->context }}</p>
                            <p class="text-sm text-gray-600">{{ $accident->description }}</p>
                            <p class="text-xs text-gray-500">Data: {{ $accident->date }} | Registrat per: {{ $accident->registrant->name ?? 'Desconegut' }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div id="accidentSenseBaixaInlineForm" class="mt-3 hidden">
            <form action="{{ route('professional.accidentabilitat.store', $professional) }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="sense_baixa">
                <div class="space-y-4 bg-white p-4 rounded border">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Data</label>
                        <input type="date" name="data" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Context</label>
                        <input type="text" name="context" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripció</label>
                        <textarea name="descripcio" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" onclick="toggleInlineForm('accidentSenseBaixaInlineForm')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel·lar</button>
                        <button type="submit" class="bg-primary_color text-white px-4 py-2 rounded">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Accident de Treball Amb Baixa -->
    <div class="space-y-4">
        <div class="flex justify-between items-center cursor-pointer" onclick="toggleCollapse('ambBaixaSection')">
            <h3 class="text-lg font-semibold text-gray-900">Accident de Treball Amb Baixa</h3>
            <div class="flex items-center space-x-2">
                <x-primary-button type="button" onclick="event.stopPropagation(); toggleInlineForm('accidentAmbBaixaInlineForm')">
                    Afegir Accident
                </x-primary-button>
                <svg id="ambBaixaSectionToggle" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </div>

        <div id="ambBaixaSection" class="bg-gray-50 p-4 rounded hidden">
            @if($accidents->where('type', 'amb_baixa')->isEmpty())
                <p class="text-gray-500">No hi ha accidents amb baixa registrats.</p>
            @else
                <div class="space-y-3">
                    @foreach($accidents->where('type', 'amb_baixa') as $accident)
                        <div class="bg-white p-3 rounded border">
                            <p class="font-medium">{{ $accident->context }}</p>
                            <p class="text-sm text-gray-600">{{ $accident->description }}</p>
                            <p class="text-xs text-gray-500">Data: {{ $accident->date }} | Durada: {{ $accident->durada }} dies | Registrat per: {{ $accident->registrant->name ?? 'Desconegut' }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div id="accidentAmbBaixaInlineForm" class="mt-3 hidden">
            <form action="{{ route('professional.accidentabilitat.store', $professional) }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="amb_baixa">
                <div class="space-y-4 bg-white p-4 rounded border">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Data</label>
                        <input type="date" name="data" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Context</label>
                        <input type="text" name="context" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripció</label>
                        <textarea name="descripcio" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Durada (dies)</label>
                        <input type="number" name="durada" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" onclick="toggleInlineForm('accidentAmbBaixaInlineForm')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel·lar</button>
                        <button type="submit" class="bg-primary_color text-white px-4 py-2 rounded">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Seguiment Baixes Llargues (Solo Equip Directiu y Administració) -->
    @if($userRole === 'Equip Directiu' || $userRole === 'Administració')
    <div class="space-y-4">
        <div class="flex justify-between items-center cursor-pointer" onclick="toggleCollapse('seguimentSection')">
            <h3 class="text-lg font-semibold text-gray-900">Seguiment Baixes Llargues</h3>
            <div class="flex items-center space-x-2">
                <x-primary-button type="button" onclick="event.stopPropagation(); toggleInlineForm('seguimentBaixesInlineForm')">
                    Afegir Seguiment
                </x-primary-button>
                <svg id="seguimentSectionToggle" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </div>

        <div id="seguimentSection" class="bg-gray-50 p-4 rounded hidden">
            @if($accidents->where('type', 'seguiment_baixes')->isEmpty())
                <p class="text-gray-500">No hi ha seguiments de baixes llargues.</p>
            @else
                <div class="space-y-3">
                    @foreach($accidents->where('type', 'seguiment_baixes') as $seguiment)
                        <div class="bg-white p-3 rounded border">
                            <p class="font-medium">{{ $seguiment->context }}</p>
                            <p class="text-sm text-gray-600">{{ $seguiment->description }}</p>
                            <p class="text-xs text-gray-500">Data: {{ $seguiment->date }} | Registrat per: {{ $seguiment->registrant->name ?? 'Desconegut' }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div id="seguimentBaixesInlineForm" class="mt-3 hidden">
            <form action="{{ route('professional.accidentabilitat.store', $professional) }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="seguiment_baixes">
                <div class="space-y-4 bg-white p-4 rounded border">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Data</label>
                        <input type="date" name="data" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Context</label>
                        <input type="text" name="context" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripció</label>
                        <textarea name="descripcio" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" onclick="toggleInlineForm('seguimentBaixesInlineForm')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel·lar</button>
                        <button type="submit" class="bg-primary_color text-white px-4 py-2 rounded">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>

<!-- Modals -->
<div id="pujarFitxaModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Pujar Fitxa d'Accidentabilitat</h3>
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fitxer</label>
                        <input type="file" name="fitxer" class="mt-1 block w-full" required>
                    </div>
                </div>
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" onclick="closeModal('pujarFitxaModal')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel·lar</button>
                    <button type="submit" class="bg-primary_color text-white px-4 py-2 rounded">Pujar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="accidentSenseBaixaModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Afegir Accident Sense Baixa</h3>
            <form action="{{ route('professional.accidentabilitat.store', $professional) }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="sense_baixa">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Data</label>
                        <input type="date" name="data" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Context</label>
                        <input type="text" name="context" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripció</label>
                        <textarea name="descripcio" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" onclick="closeModal('accidentSenseBaixaModal')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel·lar</button>
                    <button type="submit" class="bg-primary_color text-white px-4 py-2 rounded">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="accidentAmbBaixaModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Afegir Accident Amb Baixa</h3>
            <form action="{{ route('professional.accidentabilitat.store', $professional) }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="amb_baixa">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Data</label>
                        <input type="date" name="data" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Context</label>
                        <input type="text" name="context" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripció</label>
                        <textarea name="descripcio" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Durada (dies)</label>
                        <input type="number" name="durada" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                </div>
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" onclick="closeModal('accidentAmbBaixaModal')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel·lar</button>
                    <button type="submit" class="bg-primary_color text-white px-4 py-2 rounded">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($userRole === 'Equip Directiu' || $userRole === 'Administració')
<div id="seguimentBaixesModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Afegir Seguiment Baixes Llargues</h3>
            <form action="{{ route('professional.accidentabilitat.store', $professional) }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="seguiment_baixes">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Data</label>
                        <input type="date" name="data" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Context</label>
                        <input type="text" name="context" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripció</label>
                        <textarea name="descripcio" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" onclick="closeModal('seguimentBaixesModal')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel·lar</button>
                    <button type="submit" class="bg-primary_color text-white px-4 py-2 rounded">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endif