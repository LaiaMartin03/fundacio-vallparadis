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

    <h1>Alta Professionals Increíblemente Increíble</h1>

    <form action="{{ route('professional.store') }}" method="POST">
        @csrf
        Nombre: <input type="text" name="name" placeholder="Nombre del Profesional" value="{{ old('name') }}">
        <br>
        Email: <input type="email" name="email" placeholder="correo@ejemplo.com" value="{{ old('email') }}">
        <br>
        Contraseña: <input type="password" name="password" placeholder="********">
        <br>
        Locker: <input type="text" name="locker" placeholder="Locker del profesional" value="{{ old('locker') }}">
        <br>
        Código: <input type="text" name="code" placeholder="Código del profesional" value="{{ old('code') }}">
        <br>
        Info ID: <input type="text" name="info_id" placeholder="ID de info (opcional)" value="{{ old('info_id') }}">
        <br>
        <select name="active" required>
            <option value="">-- Selecciona estado --</option>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
        <br>
        <input type="submit" value="Aceptar">
    </form>
</x-app-layout>  
