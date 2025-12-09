<button class="relative flex cursor-pointer rounded-lg bg-white py-2 transition duration-300 ease-in-out" id="toggle">
  <span class="z-10 text-white text-primary_color transition duration-300 ease-in-out px-4 text-nowrap" id="opt1">
    {{ $slot1 ?? 'Opción 1' }}
  </span>
  <span class="z-10 transition text-primary_color duration-300 ease-in-out px-4 text-nowrap" id="opt2">
    {{ $slot2 ?? 'Opción 2' }}
  </span>

  <div id="over" class="absolute top-0 bottom-0 left-0 z-0 flex items-center justify-center rounded-lg bg-orange-400 px-4 py-2 text-nowrap text-transparent transition-all duration-300 ease-in-out">
    {{ $slot1 ?? 'Opción 1' }}
  </div>
</button>
