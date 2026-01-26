@if(auth()->user()->role === 'Equip Directiu' || auth()->user()->role === 'Administració' || auth()->user()->role === 'Responsable/Equip Tecnic')
<div class="space-y-6">
    <!-- Fitxa -->
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Fitxa d'Accidentabilitat</h3>
            <div class="space-x-2">
                <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-opacity-80">
                    Descarregar Fitxa
                </button>
                <button type="button" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-opacity-80" onclick="openModal('pujarFitxaModal')">
                    Pujar Fitxa
                </button>
            </div>
        </div>
        <div class="bg-gray-50 p-4 rounded">
            <p class="text-gray-500">Fitxa d'accidentabilitat imprimible.</p>
        </div>
    </div>

    <!-- Accident de Treball Sense Baixa -->
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Accident de Treball Sense Baixa</h3>
            <button type="button" class="bg-primary_color text-white px-4 py-2 rounded hover:bg-opacity-80" onclick="openModal('accidentSenseBaixaModal')">
                Afegir Accident
            </button>
        </div>

        <div class="bg-gray-50 p-4 rounded">
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
    </div>

    <!-- Accident de Treball Amb Baixa -->
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Accident de Treball Amb Baixa</h3>
            <button type="button" class="bg-primary_color text-white px-4 py-2 rounded hover:bg-opacity-80" onclick="openModal('accidentAmbBaixaModal')">
                Afegir Accident
            </button>
        </div>

        <div class="bg-gray-50 p-4 rounded">
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
    </div>

    <!-- Seguiment Baixes Llargues (Solo Equip Directiu y Administració) -->
    @if($userRole === 'Equip Directiu' || $userRole === 'Administració')
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Seguiment Baixes Llargues</h3>
            <button type="button" class="bg-primary_color text-white px-4 py-2 rounded hover:bg-opacity-80" onclick="openModal('seguimentBaixesModal')">
                Afegir Seguiment
            </button>
        </div>

        <div class="bg-gray-50 p-4 rounded">
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