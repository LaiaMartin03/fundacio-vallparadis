@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-0 border-b border-b-[#ff9740] placeholder-[#ff9740] py-2 px-0 focus:outline-none']) }}>
