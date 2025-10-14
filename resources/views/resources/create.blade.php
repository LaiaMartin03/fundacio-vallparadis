<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Crear Resource</title>
</head>
<body>
    <h1>Nuevo Recurso</h1>

    <form action="{{ route('resources.store') }}" method="POST">
        @csrf

        <label>Uniform ID:</label>
        <input type="number" name="uniform_id" required><br>

        <label>User ID:</label>
        <input type="number" name="user_id" required><br>

        <label>Given by User ID:</label>
        <input type="number" name="given_by_user_id" required><br>

        <label>Delivered At:</label>
        <input type="datetime-local" name="delivered_at"><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
