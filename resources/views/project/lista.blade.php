<x-app-layout>  
    <div class="mx-20 px-20 py-10">
        <h1 class="font-mclaren text-primary pb-10">Listado de Projectos</h1>

        @if($projects->isEmpty())
            <p>No hay projects registrados.</p>
        @else
            @foreach($projects as $project)
                <a href="{{ route('project.edit', $project->id) }}" class="bg-white shadow-lg rounded-lg p-4 mb-4 hover:bg-gray-100 flex justify-between items-center">
                    <div class="flex gap-10">
                        <span>{{ $project->name }}</span>
                        <span class="text-gray-700">{{ $project->description }}</span>
                    </div>

                    <div>
                        <span class="text-orange-500">{{ $project->type }}</span>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
</x-app-layout>
