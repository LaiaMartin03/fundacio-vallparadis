<div class="py-4">
    <h3 class="text-lg font-semibold mb-3">Sumatori de valoracions</h3>

    @if(empty($rows))
        <p class="text-gray-500">No hi ha valoracions encara.</p>
    @else
        <table class="w-full border-collapse text-sm">
            <thead>
                <tr class="bg-yellow-100">
                    <th class="p-2 border text-left">Aspecte</th>
                    <th class="p-2 border text-center">Mitjana (1..4)</th>
                    <th class="p-2 border text-center">N avaluacions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $clave => $valor)
                    <tr>
                        <td class="p-2 border">{{ $valor }}</td>
                        <td class="p-2 border text-center">
                            {{ isset($rows[$clave]) ? number_format($rows[$clave]->avg_score, 2) : '-' }}
                        </td>
                        <td class="p-2 border text-center">
                            {{ isset($rows[$clave]) ? $rows[$clave]->n : 0 }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>