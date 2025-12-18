<div data-id="4" class="relative py-4 px-6 bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-fit h-fit dragItem" draggable="true">
    <img class="rounded-full h-12 aspect-square object-cover" src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" alt="">
    <div class="flex flex-col">
        <div>{{ $nombre ?? 'User Name' }}</div>
        <div class="text-sm text-primary_color">{{ $profesion ?? '-' }}</div>
    </div>
    <button class="text-gray-300 hover:text-gray-500 cursor-pointer absolute bottom-2 right-4 hidden" id="take-out">X</button>
</div>