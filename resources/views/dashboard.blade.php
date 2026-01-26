<x-app-layout>
    <div class="flex gap-12 w-full p-12 items-stretch">
        <div class="w-2/3 space-y-8">
            <div class="bg-white p-8 rounded-lg relative">
                <div class="flex flex-col gap-3">
                    <span class="text-2xl text-gray_color">Bon dia, {{ auth()->user()->name ?? 'Usuari' }}!</span>
                    @php
                        // Keep a server-rendered fallback for SEO / noscript users.
                        date_default_timezone_set('Europe/Madrid');
                        $hora_actual = date("H:i");
                    @endphp
                    <span id="hora-actual" class="text-primary_color font-mclaren text-7xl">{{ $hora_actual }}</span>
                </div>
                <script>
                    (function(){
                        // Updates the #hora-actual span to match the user's PC time (HH:MM).
                        const el = document.getElementById('hora-actual');
                        if (!el) return;

                        function pad(n){ return n < 10 ? '0' + n : String(n); }

                        let last = null;

                        function updateTime(force){
                            const now = new Date();
                            const hh = pad(now.getHours());
                            const mm = pad(now.getMinutes());
                            const timeStr = hh + ':' + mm;
                            // Only update DOM when the displayed value actually changes
                            if (force || timeStr !== last) {
                                el.textContent = timeStr;
                                last = timeStr;
                            }
                        }

                        // Update every second to detect system time changes promptly.
                        updateTime(true);
                        const timer = setInterval(updateTime, 1000);

                        // When the page becomes visible again, force an immediate sync.
                        document.addEventListener('visibilitychange', function(){
                            if (!document.hidden) updateTime(true);
                        });

                        // If user navigates away/unloads, clear the interval.
                        window.addEventListener('beforeunload', function(){ clearInterval(timer); });
                    })();
                </script>
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
            $cursos = collect();

            if ($user) {
                if (isset($user->cursos)) {
                $cursos = $user->cursos;
                } elseif (isset($user->courses)) {
                $cursos = $user->courses;
                }
            }

            $cursos = collect($cursos);
            @endphp

            <div class="flex flex-col gap-4">
            <span class="text-2xl text-gray_color">Els teus cursos</span>

            @if($cursos->isEmpty())
                <div class="text-gray-500">No t'has apuntat a cap curs!</div>
            @else
                <ul class="space-y-3">
                @foreach($cursos as $curso)
                    <li class="p-3 bg-gray-50 rounded-md">
                    {{ $curso->name ?? $curso->titol ?? $curso->title ?? 'Curs sense nom' }}
                    </li>
                @endforeach
                </ul>
            @endif
            </div>
        </div>
    </div>
</x-app-layout>
