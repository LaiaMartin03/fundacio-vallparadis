<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Projects</title>
</head>
<body>
    <h1>Listado de Projects</h1>

    @if($projects->isEmpty())
        <p>No hay projects registrados.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Centro</th>
                    <th>Responsable</th>
                    <th>Descripción</th>
                    <th>Observaciones</th>
                    <th>Tipo</th>
                    <th>Activo</th>
                    <th>Editar</th>
                    <th>Activar/Desactivar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->center->name ?? '-' }}</td>
                        <td>{{ $project->responsible_professional ?? '-'}}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->observations }}</td>
                        <td>{{ $project->type }}</td>
                        <td>{{ $project->active ? 'Sí' : 'No' }}</td>
                        <td><a href="{{ route('project.edit', $project->id) }}">Editar</a></td>
                        <td>
                            @if (!$project->active)
                                <form action="{{ route('project.activate', $project->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit">Activar</button>
                                </form>
                            @else
                                <form action="{{ route('project.destroy', $project->id) }}" method="POST">
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
</body>
</html>
