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
    
    <h1>Editar Centre: {{ $center->name }}</h1>
    <form action="{{ route('center.update', $center->id) }}" method="POST">
        @csrf
        @method('PUT')
        Nom: <input type="text" name="name" value="{{ $center->name }}" placeholder="Nom del centre">
        <br>
        Direcció: <input type="text" name="location" value="{{ $center->location }}" placeholder="Sicilia, 321">
        <br>
        Correu: <input type="email" name="email" value="{{ $center->email }}" placeholder="centre@gmail.com">
        <br>
        Telèfon: <input type="text" name="phone" value="{{ $center->phone }}" placeholder="123456789">
        <br>
        <select name="active" required>
            <option value="">-- Selecciona estado --</option>
            <option value="1" {{ $center->active ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ !$center->active ? 'selected' : '' }}>Inactivo</option>
        </select>
        <br>
        <input type="submit" value="Actualizar">
    </form>         
</x-app-layout>  
