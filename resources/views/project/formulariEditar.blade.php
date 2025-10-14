<x-app-layout>  
    <h1>Editar Projecte: {{ $project->name }}</h1>

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

    <form action="{{ route('project.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Centre:</label>
        <select name="center_id" required>
            @foreach($centers as $center)
                <option value="{{ $center->id }}" {{ $project->center_id == $center->id ? 'selected' : '' }}>
                    {{ $center->name }}
                </option>
            @endforeach
        </select>
        <br>

        <label>Responsable:</label>
        <select name="responsible_professional" required>
            @foreach($professionals as $professional)
                <option value="{{ $professional->id }}" {{ $project->responsible_professional == $professional->id ? 'selected' : '' }}>
                    {{ $professional->name }}
                </option>
            @endforeach
        </select>
        <br>

        <label>Nom:</label>
        <input type="text" name="name" value="{{ $project->name }}">
        <br>

        <label>Descripció:</label>
        <input type="text" name="description" value="{{ $project->description }}">
        <br>

        <label>Observacions:</label>
        <input type="text" name="observations" value="{{ $project->observations }}">
        <br>

        <label>Tipus:</label>
        <select name="type">
            <option value="project" {{ $project->type == 'project' ? 'selected' : '' }}>Projecte</option>
            <option value="comision" {{ $project->type == 'comision' ? 'selected' : '' }}>Comisió</option>
        </select>
        <br>

        <button type="submit">Actualitzar</button>
    </form>
</x-app-layout>  
