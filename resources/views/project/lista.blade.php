<x-app-layout>  
    <div class="px-20 py-10 space-y-4">
        <div id="header" class="flex justify-between items-center mb-12">
            <h1 class="font-mclaren text-primary_color text-4xl">Projectes</h1>
        </div>

        @if($projects->isEmpty())
            <p>Ni hi han projectes registrats.</p>
        @else
            @foreach($projects as $project)
                <a href="{{ route('project.show', $project->id) }}" class="bg-white shadow-lg rounded-lg p-4 mb-4 hover:bg-gray-100 flex justify-between items-center">
                    <div class="flex gap-10">
                        <span>{{ $project->name }}</span>
                        <span class="text-gray-700">{{ $project->description }}</span>
                    </div>

                    <div>
                        <span class="text-orange-500">{{ $project->type === 'project' ? 'Projecte' : 'Comissió' }}</span>
                    </div>
                </a>
            @endforeach
        @endif
    </div>

    <x-add-button href="{{ route('project.create') }}"></x-add-button>
</x-app-layout>
