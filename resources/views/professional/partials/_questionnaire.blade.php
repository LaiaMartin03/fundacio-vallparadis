<div class="py-4">
    <div class="flex justify-between items-center">
        <h3 class="text-lg font-semibold mb-3">Qüestionari de valoració</h3>
        <x-primary-button id="toggle-questionnaire-btn">
            Avaluar
        </x-primary-button>
    </div>

    <form id="questionnaire" action="{{ route('professional.evaluation_form.store', $professional) }}" method="POST" class="mt-4 hidden">
        @csrf
        <div class="overflow-auto">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-primary_color text-white">
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
            <x-primary-button type="submit" >
                Enviar avaluació
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6">
        <h4 class="text-md font-semibold mb-2">Historial d'avaluacions</h4>
        @if(isset($forms) && $forms->isNotEmpty())
            <table id="evaluation-history-table" class="w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-primary_color text-white">
                        <th class="p-2 border text-left w-1/6">Data</th>
                        <th class="p-2 border text-left w-1/4">Avaluador</th>
                        <th class="p-2 border text-center w-24">Total</th>
                        <th class="p-2 border text-left ">Observacions</th>
                        <th class="p-2 border text-left w-24">Accions</th>
                    </tr>
                </thead>
                <tbody id="evaluation-history-body">
                    @foreach($forms as $form)
                        <tr id="evaluation-row-{{ $form->id }}">
                            <td class="p-2 border">{{ optional($form->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="p-2 border">{{ $form->evaluator_name ?? '—' }}</td>  
                            <td class="p-2 border text-center">
                                @if(isset($form->total))
                                    {{ sprintf('%.1f / 4', $form->total / 20) }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="p-2 border">{{ $form->observations ?? '—' }}</td>
                            <td class="p-2 border">
                                <x-primary-button id="toggle-evaluation-btn-{{ $form->id }}" data-form-id="{{ $form->id }}">
                                    Mostrar
                                </x-primary-button>
                            </td>
                        </tr>
                        <tr id="form-details-{{ $form->id }}" class="border hidden">
                            <td colspan="5" class="p-4">
                                <div class="p-4 rounded">
                                    <table class="w-full border-collapse text-sm">
                                        <thead>
                                            <tr class="bg-primary_color text-white">
                                                <th class="p-2 border text-left">Aspecte</th>
                                                <th class="p-2 border text-center">Puntuació</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($questions as $clave => $valor)
                                                <tr class="align-top">
                                                    <td class="p-2 border pr-4">{{ $valor }}</td>
                                                    <td class="p-2 border text-center">
                                                        @if($form->answers->where('question_key', $clave)->first())
                                                            {{ $form->answers->where('question_key', $clave)->first()->score }} / 4
                                                        @elseif(isset($answersByForm[$form->id][$clave]))
                                                            {{ $answersByForm[$form->id][$clave]->score }} / 4
                                                        @else
                                                            —
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p id="no-evaluations-message" class="text-gray-500">No hi ha avaluacions registrades.</p>
        @endif
    </div>
</div>