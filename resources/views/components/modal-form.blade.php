{{-- resources/views/components/modal-form.blade.php --}}
@props(['titulo', 'id'])

<div class="z-10 fixed inset-0 bg-black/50 flex items-center justify-center" role="dialog" aria-modal="true">
    <div 
        {{ $attributes->merge([
            'class' => 'py-12 w-[575px] mx-auto sm:px-6 lg:px-8 bg-white rounded-xl relative',
            'id' => $id
        ]) }}
    >
        <button 
            class="absolute text-xl text-gray-300 hover:text-gray-500 top-2 right-3" 
            data-close-modal
            aria-label="Cerrar modal"
        >X</button>
        
        <h1 class="text-2xl font-bold mb-4" id="{{ $id }}-title">{{ $titulo }}</h1>
        {{ $slot }}
    </div>
</div>