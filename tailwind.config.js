import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            /*Empezar a escribir aquí*/
            colors: {
                primary: '#FF7400',
                gray: '#575656',
                charcoal: '#37434B',
                light: '#F7F7F7',
            },
            fontFamily: {
                figtree: ['Figtree', ...defaultTheme.fontFamily.sans],
                mclaren: ['McLaren', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
