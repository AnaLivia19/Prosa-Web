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
        fontFamily: {
            sans: ['Lato', ...defaultTheme.fontFamily.sans],
            titulo: ['Fredoka', ...defaultTheme.fontFamily.sans],
        },
        colors: {
            prosa: {
                verde: '#5B7B40',
                claro: '#A3B56B',
                creme: '#F8F4E8',
                amarelo: '#D6BF45',
                destaque: '#F5D77A',
                cinza: '#5E5E5E',
            },
        },
    },
},

    plugins: [forms],
};
