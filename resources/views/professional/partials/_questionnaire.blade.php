<div class="py-4">
    <div class="flex justify-between items-center">
        <h3 class="text-lg font-semibold mb-3">Qüestionari de valoració</h3>
        <x-primary-button onclick="toggleQuestionnaire(this)">
            Avaluar
        </x-primary-button>
    </div>

    <form id="questionnaire" action="{{ route('professional.evaluation_form.store', $professional) }}" method="POST" class="mt-4 hidden">
        @csrf
        <div class="overflow-auto">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border text-left">Aspecte</th>
                        <th class="p-2 border text-center">Gens d'acord<br/>(1)</th>
                        <th class="p-2 border text-center">Poc d'acord<br/>(2)</th>
                        <th class="p-2 border text-center">Bastant d'acord<br/>(3)</th>
                        <th class="p-2 border text-center">Molt d'acord<br/>(4)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $clave => $valor)
                        <tr class="align-top">
                            <td class="p-2 border pr-4">{{ $valor }}</td>
                            @for($v=1;$v<=4;$v++)
                                <td class="p-2 border text-center">
                                    <input type="radio" name="answers[{{ $clave }}]" value="{{ $v }}" required>
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Observacions</label>
            <textarea name="observations" rows="3" class="mt-1 block w-full border rounded px-3 py-2"></textarea>
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">
                Enviar avaluació
            </button>
        </div>
    </form>

    <div class="mt-6">
        <h4 class="text-md font-semibold mb-2">Historial d'avaluacions</h4>
        @if(isset($forms) && $forms->isNotEmpty())
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border text-left">Data</th>
                        <th class="p-2 border text-left">Avaluador</th>
                        <th class="p-2 border text-center">Total</th>
                        <th class="p-2 border text-left">Observacions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forms as $form)
                        <tr>
                            <td class="p-2 border">{{ optional($form->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="p-2 border">{{ $form->evaluator_name ?? '—' }}</td>  
                            <td class="p-2 border text-center">
                                @if(isset($form->total))
                                    {{ sprintf('%.1f / 10', $form->total / 8) }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="p-2 border">{{ $form->observations ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">No hi ha avaluacions registrades.</p>
        @endif
    </div>
</div>