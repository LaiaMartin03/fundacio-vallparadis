<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Resource</title>
</head>
<body>
    <h1>Editar Recurso</h1>

    <form action="{{ route('resources.update', $resource->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Uniform ID:</label>
        <input type="number" name="uniform_id" value="{{ $resource->uniform_id }}" required><br>

        <label>User ID:</label>
        <input type="number" name="user_id" value="{{ $resource->user_id }}" required><br>

        <label>Given by User ID:</label>
        <input type="number" name="given_by_user_id" value="{{ $resource->given_by_user_id }}" required><br>

        <label>Delivered At:</label>
        <input type="datetime-local" name="delivered_at" value="{{ $resource->delivered_at ? date('Y-m-d\TH:i', strtotime($resource->delivered_at)) : '' }}"><br>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
