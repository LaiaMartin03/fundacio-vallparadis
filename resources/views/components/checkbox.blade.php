<input {{ $attributes->merge(['type' => 'checkbox', 'class' => 'cursor-pointer rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-[#FF9740] shadow-sm focus:ring-[#FF9740] dark:focus:ring-[#FF9740] dark:focus:ring-offset-gray-800']) }}>
    {{ $slot }}
</input>
