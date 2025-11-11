<nav aria-label="Breadcrumb">
    <ol class="flex items-center gap-2 text-sm">
        @foreach ($links as $label => $url)
            @php
                $isHome = strtolower($label) === 'inicio';
            @endphp

            @if ($loop->last)
                <li class="text-primary_color flex items-center gap-1">
                    @if (!$isHome)
                        {{ $label }}
                    @endif
                </li>
            @else
                <li class="flex items-center gap-1">
                    <a href="{{ $url }}" class="text-gray-500 hover:text-primary_color flex items-center gap-1">
                        @if ($isHome)
                            <svg class="size-6">
                                <use href="#home" />
                            </svg>
                        @else
                            {{ $label }}
                        @endif
                    </a>
                    <svg class="size-6">
                        <use href="#arrow" />
                    </svg>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
