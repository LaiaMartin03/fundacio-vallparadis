<?php
<div class="py-4">
    <h3 class="text-lg font-semibold mb-3">Qüestionari de valoració</h3>

    <form action="{{ route('professional.evaluation_form.store', $professional) }}" method="POST">
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
                    @foreach($questions as $key => $label)
                        <tr class="align-top">
                            <td class="p-2 border pr-4">{{ $label }}</td>
                            @for($v=1;$v<=4;$v++)
                                <td class="p-2 border text-center">
                                    <input type="radio" name="answers[{{ $key }}]" value="{{ $v }}" required>
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
</div>