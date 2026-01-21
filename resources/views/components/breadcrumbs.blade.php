<nav aria-label="Breadcrumb" class="px-5 py-3">
    <ol class="flex items-center gap-2 text-sm max-w-7xl mx-auto">
        @foreach ($links as $label => $url)
            @php
                $isHome = strtolower($label) === 'inicio';
                $isLast = $loop->last;
                $isOnDashboard = request()->routeIs('dashboard');
                $shouldShowHomeIcon = $isHome && !$isOnDashboard;
            @endphp

            @if ($isLast)
                @if (!($isHome && $isOnDashboard))
                    <li class="text-primary_color font-medium flex items-center gap-1">
                        @if ($shouldShowHomeIcon)
                            <svg class="size-5">
                                <use href="#home" />
                            </svg>
                        @else
                            {{ $label }}
                        @endif
                    </li>
                @endif
            @else
                <li class="flex items-center gap-1">
                    <a href="{{ $url }}" 
                       class="text-gray-600 hover:text-primary_color transition-colors duration-150 flex items-center gap-1 px-2 py-1 rounded-md hover:bg-gray-100">
                        @if ($shouldShowHomeIcon)
                            <svg class="size-5">
                                <use href="#home" />
                            </svg>
                        @else
                            {{ $label }}
                        @endif
                    </a>
                    <svg class="size-4 text-gray-400">
                        <use href="#arrow" />
                    </svg>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
