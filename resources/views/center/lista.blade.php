<x-app-layout>  

    <h1>Listado de Centers</h1>

    @if($centers->isEmpty())
        <p>Ni hi han centres registrats.</p>
    @else
        <table border="1">
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
</x-app-layout>  
