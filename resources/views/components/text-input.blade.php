@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-b border-b-[#ff9740] placeholder-[#ff9740] pb-2 focus:outline-none']) }}>
