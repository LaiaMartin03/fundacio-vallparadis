<x-app-layout>
    <div class="flex gap-12 w-full p-12 items-stretch">
        <div class="w-2/3 space-y-8">
            <div class="bg-white p-8 rounded-lg relative">
                <div class="flex flex-col gap-3">
                    <span class="text-2xl text-gray_color">Bon dia, Yolanda!</span>
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
                <a href="{{ route('curso.index') }}" class="bg-white p-5 rounded-lg relative h-44 overflow-hidden group ">
                    <span class="text-3xl font-medium text-gray-300 group-hover:text-charcoal_color transition duration-300 ease-in-out">Cursos</span>
                    <svg class="size-44 group-hover:opacity-50 absolute -bottom-8 text-primary_color opacity-25 -right-5 transition duration-300 ease-in-out">
                        <use href="#course" />
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
            </div>
        </div>
        <div class="rounded-lg bg-white p-5 w-1/3"></div>
    </div>
</x-app-layout>
