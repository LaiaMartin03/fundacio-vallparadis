<x-app-layout>
    <div class="flex gap-12 w-full p-12 items-stretch">
        <div class="w-2/3 space-y-8">
            <div class="bg-white p-8 rounded-lg relative">
                <div class="flex flex-col gap-3">
                    <span class="text-2xl text-gray_color">Bon dia, {{ auth()->user()->name ?? 'Usuari' }}!</span>
                    @php
                        date_default_timezone_set('Europe/Madrid');
                        $hora_actual = date("H:i");
                    @endphp
                    <span class="text-primary_color font-mclaren text-7xl">{{ $hora_actual }}</span>
                </div>
                <img src="../assets/Hola.svg" alt="" class="absolute top-0 bottom-0 m-auto right-10">
            </div>
            <hr class="border-primary_color">
            <div class="grid grid-cols-2 grid-rows-2 gap-8">
                <a href="{{ route('hr.index') }}" class="bg-white p-5 rounded-lg relative h-44 overflow-hidden group ">
                    <span class="text-3xl font-medium text-gray-300 group-hover:text-charcoal_color transition duration-300 ease-in-out">Temes pendents RRHH</span>
                    <svg class="size-44 group-hover:opacity-50 absolute -bottom-8 text-primary_color opacity-25 -right-5 transition duration-300 ease-in-out">
                        <use href="#folder" />
                    </svg>
                </a>
                <a href="{{ route('professional.index') }}" class="bg-white p-5 rounded-lg relative h-44 overflow-hidden group ">
                    <span class="text-3xl font-medium text-gray-300 group-hover:text-charcoal_color transition duration-300 ease-in-out">Professionals</span>
                    <svg class="size-44 group-hover:opacity-50 absolute -bottom-8 text-primary_color opacity-25 -right-5 transition duration-300 ease-in-out">
                        <use href="#user" />
                    </svg>
                </a>
                <a href="{{ route('project.index') }}" class="bg-white p-5 rounded-lg relative h-44 overflow-hidden group ">
                    <span class="text-3xl font-medium text-gray-300 group-hover:text-charcoal_color transition duration-300 ease-in-out">Projectes</span>
                    <svg class="size-44 group-hover:opacity-50 absolute -bottom-8 text-primary_color opacity-25 -right-5 transition duration-300 ease-in-out">
                        <use href="#project" />
                    </svg>
                </a>
                <a href="{{ route('outsiders.index') }}" class="bg-white p-5 rounded-lg relative h-44 overflow-hidden group ">
                    <span class="text-3xl font-medium text-gray-300 group-hover:text-charcoal_color transition duration-300 ease-in-out">Outsiders</span>
                    <svg class="size-44 group-hover:opacity-50 absolute -bottom-8 text-primary_color opacity-25 -right-5 transition duration-300 ease-in-out">
                        <use href="#contacts" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="rounded-lg bg-white p-5 w-1/3">
            @php
            $user = auth()->user();
            $projects = collect();

            if ($user) {
                $projectIds = \App\Models\Projectdistribution::where('user_id', $user->id)->pluck('project_id');
                $projects = \App\Models\Project::whereIn('id', $projectIds)->get();
            }
            @endphp

            <div class="flex flex-col gap-4">
            <span class="text-2xl text-gray_color">Els teus projectes</span>

            @if($projects->isEmpty())
                <div class="text-gray-500">No estàs assignat a cap projecte!</div>
            @else
                <ul class="space-y-3">
                @foreach($projects as $project)
                    <a href="{{ route('project.show', $project->id) }}" class="block p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition hover:text-primary_color hover:transition duration-200">
                    {{ $project->name }}
                    </a>
                @endforeach
                </ul>
            @endif
            </div>
        </div>
    </div>
</x-app-layout>
