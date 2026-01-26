<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 h-screen w-20 fixed top-0 left-0">
    <div class="flex flex-col items-center py-4 h-full shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="h-9 w-auto fill-current" />
        </a>

        <div class="flex flex-col mt-16 space-y-6 items-center">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" title="Inici">
                <svg class="size-5">
                    <use href="#home"></use>
                </svg>
            </x-nav-link>
            @if(in_array(auth()->user()->role, ['Equip Directiu', 'Administració', 'Responsable/Equip Tecnic']))
            <x-nav-link :href="route('professional.index')" :active="request()->routeIs('professional.index')" title="Professionals">
                <svg class="size-5">
                    <use href="#user"></use>
                </svg>
            </x-nav-link>
            <x-nav-link :href="route('project.index')" :active="request()->routeIs('project.index')" title="Projectes">
                <svg class="size-5">
                    <use href="#project"></use>
                </svg>
            </x-nav-link>
            <x-nav-link :href="route('curso.index')" :active="request()->routeIs('curso.index')" title="Cursos">
                <svg class="size-5">
                    <use href="#course"></use>
                </svg>
            </x-nav-link>
            <x-nav-link :href="route('outsiders.index')" :active="request()->routeIs('outsiders.index')" title="Contactes externs">
                <svg class="size-5">
                    <use href="#contacts"></use>
                </svg>
            </x-nav-link>
            @endif
            @if(in_array(auth()->user()->role, ['Equip Directiu', 'Administració']))
            <x-nav-link :href="route('manteniment.index')" :active="request()->routeIs('manteniment.index')" title="Mantenimiento">
                <svg class="size-5">
                    <use href="#puzzle"></use>
                </svg>
            </x-nav-link>
            @endif
            @if(in_array(auth()->user()->role, ['Equip Directiu', 'Administració', 'Responsable/Equip Tecnic']))
            <x-nav-link :href="route('serveis.index')" :active="request()->routeIs('serveis.index')" title="Serveis">
                <svg class="size-5">
                    <use href="#puzzle"></use>
                </svg>
            </x-nav-link>

            <x-nav-link :href="route('hr.index')" :active="request()->routeIs('hr.index')" title="Temes pendents RRHH">
                <svg class="size-5">
                    <use href="#folder"></use>
                </svg>
            </x-nav-link>

            <x-nav-link :href="route('internal-docs.index')" :active="request()->routeIs('internal-docs.*')" title="Documentació interna">
                <svg class="size-5">
                    <use href="#document"></use>
                </svg>
            </x-nav-link>
            @endif
        </div>  
        
        <!--<x-nav-link :href="route('professional.index')" :active="request()->routeIs('professional.index')" title="Settings" class="mt-auto">
            <svg class="size-5">
                <use href="#gear"></use>
            </svg>
        </x-nav-link>-->
    </div>
</nav>

<div class="p-5 pb-0 grid grid-cols-3">
    @if(!empty($breadcrumbs) && is_array($breadcrumbs))
        <x-breadcrumbs :links="$breadcrumbs" />
    @endif

    <div id="calendar" class="flex items-center justify-self-center gap-3" x-data="window.calendar()">
        <!--<x-dropdown align="right" width="64" contentClasses="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg shadow p-3">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <svg class="size-5">
                        <use href="#calendar"></use>
                    </svg>
                    <div class="ml-2 flex flex-col">
                        <span class="text-base font-semibold leading-tight" x-text="selectedDateDayMonth"></span>
                        <span class="text-xs text-gray-400 leading-tight" x-text="selectedDateYear"></span>
                    </div>
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <div @click.stop class="flex items-center justify-between mb-3">
                    <button @click.stop="previousMonth()" class="p-1 hover:bg-gray-100 dark:hover:bg-gray-800 rounded transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <div class="text-center text-sm font-medium" x-text="currentMonthYear"></div>
                    <button @click.stop="nextMonth()" class="p-1 hover:bg-gray-100 dark:hover:bg-gray-800 rounded transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
                <div @click.stop class="grid grid-cols-7 text-xs text-center text-gray-500 mb-2">
                    <div>L</div><div>M</div><div>X</div><div>J</div><div>V</div><div>S</div><div>D</div>
                </div>
                <div @click.stop class="grid grid-cols-7 gap-1 text-sm text-center">
                    <template x-for="(day, index) in calendarDays" :key="`${day.date.getTime()}-${index}`>
                        <button 
                            @click.stop="selectDate(day.date, $event)"
                            :class="{
                                'opacity-30': !day.isCurrentMonth,
                                'bg-primary_color text-white rounded': day.isSelected,
                                'hover:bg-gray-100 dark:hover:bg-gray-800 rounded': day.isCurrentMonth && !day.isSelected,
                                'font-semibold': day.isToday
                            }"
                            class="py-1 px-1 transition"
                            :disabled="!day.isCurrentMonth">
                            <span x-text="day.day"></span>
                        </button>
                    </template>
                </div>
            </x-slot>
        </x-dropdown>-->
    </div>

    <div class="flex flex-col items-center ml-auto">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="gap-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-primary_color group dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <div class="bg-primary_color rounded-full w-7 h-7 items-center flex justify-center border-2 border-primary_color group-hover:border-gray-700 transition duration-150 ease-in"></div>
                    <div>{{ Auth::user()->name }}</div>
                </button>
            </x-slot>

            <x-slot name="content">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</div>
