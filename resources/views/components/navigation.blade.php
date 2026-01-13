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

            <x-nav-link :href="route('manteniment.index')" :active="request()->routeIs('manteniment.index')" title="Manteniment">
                <svg class="size-5">
                    <use href="#puzzle"></use>
                </svg>
            </x-nav-link>

            <x-nav-link :href="route('hr.index')" :active="request()->routeIs('hr.index')" title="Manteniment">
                <svg class="size-5">
                    <use href="#folder"></use>
                </svg>
            </x-nav-link>
        </div>  
        
        <x-nav-link :href="route('professional.index')" :active="request()->routeIs('professional.index')" title="Settings" class="mt-auto">
            <svg class="size-5">
                <use href="#gear"></use>
            </svg>
        </x-nav-link>
    </div>
</nav>

<div class="ml-20 p-5 flex justify-center items-center">
    <div id="calendar" class="flex items-center gap-3 ml-auto">
        <x-dropdown align="right">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <svg class="size-5">
                        <use href="#calendar"></use>
                    </svg>
                    <span class="text-sm ml-2">14 d'Octubre 2025</span>
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content" class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg shadow p-3 w-64">
                    <div class="text-center text-sm font-medium mb-2">
                    Noviembre 2025
                    </div>
                    <div class="grid grid-cols-7 text-xs text-center text-gray-500 mb-2">
                    <div>L</div><div>M</div><div>X</div><div>J</div><div>V</div><div>S</div><div>D</div>
                    </div>
                    <div class="grid grid-cols-7 gap-1 text-sm text-center">
                    <div class="opacity-30">27</div><div class="opacity-30">28</div><div class="opacity-30">29</div><div class="opacity-30">30</div><div>1</div><div>2</div><div>3</div>
                    <div>4</div><div>5</div><div>6</div><div>7</div><div>8</div><div>9</div><div>10</div>
                    <div>11</div><div>12</div><div>13</div><div>14</div><div>15</div><div>16</div><div>17</div>
                    <div>18</div><div>19</div><div>20</div><div>21</div><div>22</div><div>23</div><div>24</div>
                    <div>25</div><div>26</div><div>27</div><div>28</div><div>29</div><div>30</div><div class="opacity-30">1</div>
                    </div>
            </x-slot>
        </x-dropdown>
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
                <x-dropdown-link :href="route('professional.edit', Auth::user()->id)">
                    {{ __('Profile') }}
                </x-dropdown-link>
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
