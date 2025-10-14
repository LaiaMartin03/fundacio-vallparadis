<x-app-layout>  
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
            <select name="active" required>
                <option value="">-- Selecciona estado --</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <br>
            <input type="submit" value="Acceptar">
        </form>         
</x-app-layout>  
