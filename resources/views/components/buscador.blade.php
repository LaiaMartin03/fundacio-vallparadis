@props([
    'label' => 'Cercar',
    'placeholder' => 'Escriu per cercar...',
])

<!-- Buscador -->
<div id="filters" class="w-fit flex items-center relative">
    <input type="text" id="search-input" placeholder="{{ $placeholder }}" class="w-96 py-2 border-none rounded-lg focus:ring-2 focus:ring-primary_color focus:border-transparent">
    <svg class="size-5 text-gray-400 absolute right-4">
        <use href="#search"></use>
    </svg>
</div>
