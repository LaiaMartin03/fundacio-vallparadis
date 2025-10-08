<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('professional.index') }}">Professional (lista)</a>
    <br>
    <a href="{{ route('professional.create') }}">Professional (create)</a>
    <br>
    <hr>
    <a href="{{ route('center.index') }}">Center (lista)</a>
    <br>
    <a href="{{ route('center.create') }}">Center (Create)</a>
    <br>
    <hr>
    <a href="{{ route('project.index') }}">Project (lista)</a>
    <br>
    <a href="{{ route('project.create') }}">Project (Create)</a>
</body>
</html>