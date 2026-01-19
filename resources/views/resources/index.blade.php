<x-app-layout>  

    <h1>Listado de Recursos</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('resources.create') }}">Crear nuevo recurso</a>
    <a href="{{ route('resources.export') }}">Exportar a Excel</a>

    @if ($resources->isEmpty())
        <p>Ni hi han recursos registrats.</p>
    @else
        <table border="1" cellpadding="5">
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
</x-app-layout>  
