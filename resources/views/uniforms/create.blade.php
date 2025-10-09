<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Crear Uniforme</title>
</head>
<body>
    <h1>Nuevo Uniforme</h1>

    <form action="{{ route('uniforms.store') }}" method="POST">
        @csrf
        <label>Dado por (User ID):</label>
        <input type="number" name="given_by_user_id"><br>

        <label>Usuario ID:</label>
        <input type="number" name="user_id"><br>

        <label>Talla Camisa:</label>
        <input type="number" name="shirt_size"><br>

        <label>Talla Pantalón:</label>
        <input type="number" name="pants_size"><br>

        <label>Bata:</label>
        <select name="lab_coat">
            <option value="0">No</option>
            <option value="1">Sí</option>
        </select><br>

        <label>Talla Zapatos:</label>
        <input type="number" name="shoe_size"><br>

        <label>Fecha Entrega:</label>
        <input type="datetime-local" name="delivery_at"><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
