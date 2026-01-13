<div {{ $attributes->merge(['class' => 'py-4 px-6 bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-fit h-fit dragItem', 'draggable' => 'true', 'data-id' => $id ?? '']) }}>
    <img class="rounded-full h-12 aspect-square object-cover" src="{{ $avatar ?? 'https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0' }}">
    <div class="flex flex-col">
        <div>{{ $name ?? 'Nombre' }}</div>
        <div class="text-sm text-primary_color">{{ $profession ?? 'Profesión' }}</div>
    </div>
    <button class="text-gray-300 hover:text-gray-500 cursor-pointer absolute bottom-2 right-4 hidden" id="take-out">X</button>
</div>
