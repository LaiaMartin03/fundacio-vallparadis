<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Professional</title>
</head>
<body>
    <h3>
        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @elseif ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </h3>


    <form action="{{ route('professional.update', $professional->id) }}" method="POST">
        @csrf
        @method('PUT')

        Nombre: <input type="text" name="username" placeholder="Nombre del Profesional" value="{{ old('username', $professional->username) }}">
        <br>
        Email: <input type="email" name="email" placeholder="correo@ejemplo.com" value="{{ old('email', $professional->email) }}">
        <br>
        Contraseña: <input type="password" name="password" placeholder="********">
        <br>
        Locker: <input type="text" name="locker" placeholder="Locker del profesional" value="{{ old('locker', $professional->locker) }}">
        <br>
        Código: <input type="text" name="code" placeholder="Código del profesional" value="{{ old('code', $professional->code) }}">
        <br>
        Info ID: <input type="text" name="info_id" placeholder="ID de info (opcional)" value="{{ old('info_id', $professional->info_id) }}">
        <br>
        Actiu:
        <select name="active" required>
            <option value="">-- Selecciona estado --</option>
            <option value="1" {{ $professional->active ? 'selected' : '' }}>Sí</option>
            <option value="0" {{ !$professional->active ? 'selected' : '' }}>No</option>
        </select>
        <br>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
