<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Alta Centres Increiblemente Increible</h1>
    <form action="{{route('insertCenter')}}" method="POST">
        @csrf
        Nom: <input type="text" name="name">
        <br>
        Direcció: <input type="text" name="location" placeholder="Sicilia, 321">
        <br>
        <input type="submit" value="Acceptar">
    </form>         
</body>
</html>