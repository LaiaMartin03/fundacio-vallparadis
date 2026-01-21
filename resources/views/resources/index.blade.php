<x-app-layout>  
    <div class="px-20 py-10">
        <div id="header" class="flex justify-between items-center mb-8">
            <h1 class="font-mclaren text-primary_color text-4xl">Recursos</h1>
        </div>

        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <div class="flex gap-4 mb-4">
            <a href="{{ route('resources.create') }}">
                <x-primary-button>Crear nuevo recurso</x-primary-button>
            </a>
            <a href="{{ route('resources.export') }}">
                <x-primary-button>Exportar a Excel</x-primary-button>
            </a>
        </div>

        <x-buscador 
            label="Cercar recursos" 
            placeholder="Escriu per cercar..." 
        />

        @if ($resources->isEmpty())
            <p>Ni hi han recursos registrats.</p>
        @else
            <table border="1" cellpadding="5" id="resources-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Uniform ID</th>
                    <th>User ID</th>
                    <th>Given by User ID</th>
                    <th>Delivered At</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resources as $resource)
                    <tr>
                        <td>{{ $resource->id }}</td>
                        <td>{{ $resource->uniform_id }}</td>
                        <td>{{ $resource->user_id }}</td>
                        <td>{{ $resource->given_by_user_id }}</td>
                        <td>{{ $resource->delivered_at }}</td>
                        <td><a href="{{ route('resources.edit', $resource->id) }}">Editar</a></td>
                        <td>
                            <form action="{{ route('resources.destroy', $resource->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-input');
                const table = document.getElementById('resources-table');
                
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
