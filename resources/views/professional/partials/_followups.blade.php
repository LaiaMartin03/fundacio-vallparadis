
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white rounded-xl">
    {{-- Formulari per afegir seguiment --}}
    <div class="pt-4 border-t">
        <h3 class="text-lg font-semibold mb-3">Afegeix seguiment</h3>

        <form action="{{ route('professional.followups.store', $professional->id) }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tipus</label>
                    <select name="type" required class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                        <option value="obert">SEGUIMENT - OBERT</option>
                        <option value="restringit">SEGUIMENT - RESTRINGIT</option>
                        <option value="origen">ORIGEN</option>
                        <option value="fi_vinculacio">FI DE LA VINCULACIÓ</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Data</label>
                    <input type="date" name="date" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tema</label>
                    <input type="text" name="topic" maxlength="255" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Descripció</label>
                <textarea name="description" rows="4" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Attached docs (ruta o URL)</label>
                <input type="text" name="attached_docs" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Afegir seguiment
                </button>
            </div>
        </form>
    </div>
    {{-- Llistat de seguiments --}}
    <div class="space-y-3 mb-6">
        <h2 class="text-2xl font-bold mb-4">Seguiments</h2>
        @if($followups->isEmpty())
            <p class="text-gray-500">No hi ha seguiments.</p>
        @else
            @foreach($followups as $f)
                <div class="border rounded-md p-4 bg-gray-50">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="font-semibold text-lg">{{ $f->topic ?? '—' }}</div>
                            <div class="text-sm text-gray-500">
                                {{ $f->date ?? $f->created_at->format('Y-m-d') }} · Registrat per: {{ optional($f->registrant)->name ?? '—' }}
                            </div>
                        </div>
                        <div>
                            <span class="inline-block px-2 py-1 text-xs font-medium bg-gray-200 rounded">{{ strtoupper($f->type) }}</span>
                        </div>
                    </div>

                    @if(!empty($f->description))
                        <p class="mt-3 text-gray-700">{{ $f->description }}</p>
                    @endif

                    @if(!empty($f->attached_docs))
                        <div class="mt-2 text-sm">
                            Arxius:
                            <a href="{{ $f->attached_docs }}" target="_blank" class="text-blue-600 underline">Veure</a>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>

    
</div>
