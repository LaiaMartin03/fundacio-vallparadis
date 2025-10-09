<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Uniformes</title>
</head>
<body>
    <h1>Listado de Uniformes</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('uniforms.create') }}">Crear nuevo uniforme</a>
    <a href="{{ route('uniforms.export') }}">Exportar a Excel</a>

    <form action="{{ route('uniforms.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="excel_file" required>
        <button type="submit">Importar</button>
    </form>

    @if ($uniforms->isEmpty())
        <p>No hay uniformes registrados.</p>
    @else
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Dado por</th>
                    <th>Usuario</th>
                    <th>Camisa</th>
                    <th>Pantalón</th>
                    <th>Bata</th>
                    <th>Zapatos</th>
                    <th>Entrega</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($uniforms as $uniform)
                    <tr>
                        <td>{{ $uniform->id }}</td>
                        <td>{{ $uniform->given_by_user_id }}</td>
                        <td>{{ $uniform->user_id }}</td>
                        <td>{{ $uniform->shirt_size }}</td>
                        <td>{{ $uniform->pants_size }}</td>
                        <td>{{ $uniform->lab_coat ? 'Sí' : 'No' }}</td>
                        <td>{{ $uniform->shoe_size }}</td>
                        <td>{{ $uniform->delivery_at }}</td>
                        <td><a href="{{ route('uniforms.edit', $uniform->id) }}">Editar</a></td>
                        <td>
                            <form action="{{ route('uniforms.destroy', $uniform->id) }}" method="POST">
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
</body>
</html>
