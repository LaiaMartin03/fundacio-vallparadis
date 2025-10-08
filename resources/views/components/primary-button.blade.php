<button {{ $attributes->merge(['type' => 'submit', 'class' => 'rounded-full bg-[#FF9740] px-10 py-2 text-white cursor-pointer hover:bg-white hover:text-[#FF9740] border border-[#ff9740] transition duration-300 ease-in-out']) }}>
    {{ $slot }}
</button>
