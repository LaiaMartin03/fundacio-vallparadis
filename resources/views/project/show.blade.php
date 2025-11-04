<x-app-layout>
    <div class="mx-20 px-20 py-10 space-y-4">
        <div class="flex justify-between gap-16 max-w-screen">
            
            <div class="flex flex-col gap-2">
                <h1 class="font-mclaren text-primary_color text-4xl">{{ $project->name }}</h1>
                <h2 class="font-mclaren text-primary_color text-2xl"> {{ $project->type === 'Project' ? 'Projecte' : 'Comissió' }}</h2>
                <h3 class="font-mclaren text-md mt-4 wrap overflow-wrap break-words break-all">{{ $project->description }} </h3>
            </div>

            <div class="flex  flex-col shrink-0 ">
                <p class="mb-2"><strong>Professional responsable:</strong> {{ $project->professional->name }}</p>
                <p class="mb-2"><strong>Data d'inici:</strong> {{ $project->start_date }}</p>
                <p class="mb-2"><strong>Data de finalització:</strong> {{ $project->finish_date ?? 'No especificada' }}</p>
                <p class="mb-2"><strong>Centre associat:</strong> {{ $project->center->name }}</p>
            </div>

        </div>
        
        
        
        
        
        
        
        
        
        
        
        <div class="bg-white shadow-lg rounded-lg p-4 mb-4">

            <p class="mb-2"><strong>Tipus:</strong> {{ $project->type }}</p>
            <p class="mb-2"><strong>Data d'inici:</strong> {{ $project->start_date }}</p>
            <p class="mb-2"><strong>Data de finalització:</strong> {{ $project->finish_date ?? 'No especificada' }}</p>
            <p class="mb-2"><strong>Centre associat:</strong> {{ $project->center->name }}</p>
            <p class="mb-2"><strong>Professional responsable:</strong> {{ $project->professional->name }}</p>
        </div>
        </div>
</x-app-layout>