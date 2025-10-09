<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Uniforme</title>
</head>
<body>
    <h1>Editar Uniforme</h1>

    <form action="{{ route('uniforms.update', $uniform->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Dado por (User ID):</label>
        <input type="number" name="given_by_user_id" value="{{ $uniform->given_by_user_id }}"><br>

        <label>Usuario ID:</label>
        <input type="number" name="user_id" value="{{ $uniform->user_id }}"><br>

        <label>Talla Camisa:</label>
        <input type="number" name="shirt_size" value="{{ $uniform->shirt_size }}"><br>

        <label>Talla Pantalón:</label>
        <input type="number" name="pants_size" value="{{ $uniform->pants_size }}"><br>

        <label>Bata:</label>
        <select name="lab_coat">
            <option value="0" {{ !$uniform->lab_coat ? 'selected' : '' }}>No</option>
            <option value="1" {{ $uniform->lab_coat ? 'selected' : '' }}>Sí</option>
        </select><br>

        <label>Talla Zapatos:</label>
        <input type="number" name="shoe_size" value="{{ $uniform->shoe_size }}"><br>

        <label>Fecha Entrega:</label>
        <input type="datetime-local" name="delivery_at" value="{{ $uniform->delivery_at }}"><br>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
