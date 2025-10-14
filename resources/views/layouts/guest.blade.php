<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex flex-col relative min-h-screen font-poppins">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-tr from-[#FFDDC0] to-white dark:bg-gray-900">
            <img src="fvallparadis-logo.svg" alt="" class="absolute top-5 right-5 h-[60px]">

            <img src="assets/Riu.svg" alt="" class="absolute top-[100px] left-[350px] h-[400px]">
            <div class="w-full sm:max-w-md p-[50px] bg-white dark:bg-gray-800 overflow-hidden sm:rounded-[20px] z-10 flex flex-col items-center gap-[20px]">
                {{ $slot }}
            </div>
            <img src="assets/Dona.svg" alt="" class="absolute bottom-[50px] right-[200px] h-[400px]">
        </div>
    </body>
</html>