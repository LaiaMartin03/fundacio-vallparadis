<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
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

        <h1>Alta Projects Increiblemente Increible</h1>
        <form action="{{route('project.store')}}" method="POST">
            @csrf
            <select name="center_id" required>
                <option value="">-- Selecciona un centre --</option>
                @foreach($centers as $center)
                    <option value="{{ $center->id }}">{{ $center->name }}</option>
                @endforeach
            </select>
            
            <select name="responsible_professional" required>
                <option value="">-- Selecciona un professional --</option>
                @foreach($professionals as $professional)
                    <option value="{{ $professional->id }}">{{ $professional->username }}</option>
                @endforeach
            </select>
            <br>
            Nom: <input type="text" name="name" placeholder="Nom del Projecte">
            <br>
            Description: <input type="text" name="description" placeholder="El projecte consisteix...">
            <br>
            Observations: <input type="text" name="observations" placeholder="centre@gmail.com">
            <br>
            <select name="type">
                <option value="">-- Selecciona una tipus --</option>
                <option value="project">Projecte</option>
                <option value="comision">Comisió</option>
            </select>
            <br>
            <select name="active" required>
                <option value="">-- Selecciona estado --</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <br>
            <input type="submit" value="Acceptar">
        </form>         
    </body>
</html>