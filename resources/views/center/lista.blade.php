<x-app-layout>  
    <div class="px-20 py-10">
        <div id="header" class="flex justify-between items-center mb-8">
            <h1 class="font-mclaren text-primary_color text-4xl">Centres</h1>
        </div>

        <x-buscador 
            label="Cercar centres" 
            placeholder="Escriu per cercar..." 
        />

        @if($centers->isEmpty())
            <p>Ni hi han centres registrats.</p>
        @else
            <table border="1" id="centers-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Activo</th>
                    <th>Editar</th>
                    <th>Activar/Desactivar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($centers as $center)
                    <tr>
                        <td>{{ $center->name }}</td>
                        <td>{{ $center->location }}</td>
                        <td>{{ $center->email }}</td>
                        <td>{{ $center->phone }}</td>
                        <td>{{ $center->active ? 'Sí' : 'No' }}</td>
                        <td><a href="{{ route('center.edit', $center) }}">Editar</a></td>
                        <td>
                            @if (!$center->active)
                                <form action="{{ route('center.activate', $center->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit">Activar</button>
                                </form>
                            @else
                                <form action="{{ route('center.destroy', $center->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Desactivar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-input');
                const table = document.getElementById('centers-table');
                
                if (!searchInput || !table) return;
                
                const rows = Array.from(table.querySelectorAll('tbody tr'));
                
                searchInput.addEventListener('input', function() {
                    const term = this.value.trim().toLowerCase();
                    
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(term) ? '' : 'none';
                    });
                });
            });
        </script>
    </div>
</x-app-layout>  
