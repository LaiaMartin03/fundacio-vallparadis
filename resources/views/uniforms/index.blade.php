<x-app-layout>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white rounded-xl flex flex-col gap-8">
        <div class="flex gap-12">
            <form action="{{ route('uniforms.import') }}" method="POST" enctype="multipart/form-data" class="border p-3 rounded-xl text-sm">
                @csrf
                <input type="file" name="excel_file" required>
                <button type="submit">Importar</button>
            </form>

            <x-nav-link href="{{ route('uniforms.create') }}" class="ml-auto">Crear nuevo uniforme</x-nav-link>
            <x-nav-link href="{{ route('uniforms.export') }}">Exportar a Excel</x-nav-link>
        </div>

        

        @if ($uniforms->isEmpty())
            <p>Ni hi han uniformes registrats.</p>
        @else
            @foreach($uniforms as $uniform)
                <a href="{{ route('uniform.edit', $uniform->id) }}" class="bg-white shadow-lg rounded-lg p-4 mb-4 hover:bg-gray-100 flex justify-between items-center">
                    <div class="flex gap-10">
                        <span>{{ $uniform->name }}</span>
                        <span class="text-gray-700">{{ $uniform->description }}</span>
                    </div>

                    <div>
                        <span class="text-orange-500">{{ $uniform->type }}</span>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
</x-app-layout>