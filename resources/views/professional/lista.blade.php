<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Professionals</title>
</head>
<body>
    <h1>Listado de Professionals</h1>

    @if($professionals->isEmpty())
        <p>No hay professionals registrados.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nom</th>
                    <th>Taquilla</th>
                    <th>Codi</th>
                    <th>Actiu</th>
                    <th>Editar</th>
                    <th>Descactivar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($professionals as $professional)
                    <tr>
                        <td>{{ $professional->email }}</td>
                        <td>{{ $professional->username }}</td>
                        <td>{{ $professional->locker }}</td>
                        <td>{{ $professional->code }}</td>
                        <td>{{ $professional->active ? 'Actiu' : 'Inactiu' }}</td>
                        <td><a href="{{ route('professional.edit', $professional) }}">Editar</a></td>
                        <td> 
                            @if (!$professional->active)
                                <form action="{{ route('professional.activate', $professional->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit">Activar</button>
                                </form>
                            @else
                                <form action="{{ route('professional.destroy', $professional->id) }}" method="POST" >
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
        <a href="{{ route('professionals.export') }}">
            <button> Exportar a Excel</button>
        </a>
    @endif
</body>
</html>
