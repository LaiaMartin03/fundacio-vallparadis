@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 py-1 border-b-2 border-[#FF7400] dark:border-[#FF7400] text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-[#FF7400] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 py-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-[#FF7400] dark:hover:text-[#FF7400] hover:border-[#FF7400] dark:hover:border-[#FF7400] focus:outline-none focus:text-[#FF7400] dark:focus:text-[#FF7400] focus:border-[#FF7400] dark:focus:border-[#FF7400] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>