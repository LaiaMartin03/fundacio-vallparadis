<nav aria-label="Breadcrumb" class="px-5 py-3 bg-white/50 backdrop-blur-sm border-b border-gray-200">
    <ol class="flex items-center gap-2 text-sm max-w-7xl mx-auto">
        @foreach ($links as $label => $url)
            @php
                $isHome = strtolower($label) === 'inicio';
                $isLast = $loop->last;
            @endphp

            @if ($isLast)
                <li class="text-primary_color font-medium flex items-center gap-1">
                    @if (!$isHome)
                        {{ $label }}
                    @else
                        <svg class="size-5">
                            <use href="#home" />
                        </svg>
                    @endif
                </li>
            @else
                <li class="flex items-center gap-1">
                    <a href="{{ $url }}" 
                       class="text-gray-600 hover:text-primary_color transition-colors duration-150 flex items-center gap-1 px-2 py-1 rounded-md hover:bg-gray-100">
                        @if ($isHome)
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
