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
        <h1>Alta Centres Increiblemente Increible</h1>
        <form action="{{route('center.store')}}" method="POST">
            @csrf
            Nom: <input type="text" name="name" placeholder="Nom del centre">
            <br>
            Direcció: <input type="text" name="location" placeholder="Sicilia, 321">
            <br>
            Correu: <input type="email" name="email" placeholder="centre@gmail.com">
            <br>
            Telèfon: <input type="text" name="phone" placeholder="123456789">
            <br>
            <input type="submit" value="Acceptar">
        </form>         
    </body>
</html>