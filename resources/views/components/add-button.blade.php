@props(['href' => '#'])

<a href="{{ $href }}" class="aspect-square border border-primary_color rounded-full bg-white p-4 fixed bottom-16 right-20 z-10 group transition duration-300 ease-in-out hover:bg-primary_color">
    <svg class="size-7 text-primary_color group-hover:text-white transition duration-300 ease-in-out">
        <use href="#plus" />
    </svg>
</a>
