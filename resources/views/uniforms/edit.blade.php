<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white rounded-xl">
        <h1>Editar Uniforme</h1>

        <form action="{{ route('uniforms.update', $uniform->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Talla Camisa:</label>
            <input type="number" name="shirt_size" value="{{ $uniform->shirt_size }}"><br>

            <label>Talla Pantalón:</label>
            <input type="number" name="pants_size" value="{{ $uniform->pants_size }}"><br>

            <label>Bata:</label>
            <select name="lab_coat">
                <option value="0" {{ !$uniform->lab_coat ? 'selected' : '' }}>No</option>
                <option value="1" {{ $uniform->lab_coat ? 'selected' : '' }}>Sí</option>
            </select><br>

            <label>Talla Zapatos:</label>
            <input type="number" name="shoe_size" value="{{ $uniform->shoe_size }}"><br>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</x-app-layout>
