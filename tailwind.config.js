import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#fef2f3',
                    100: '#fde6e8',
                    200: '#fbd0d6',
                    300: '#f8a9b5',
                    400: '#f3798e',
                    500: '#e83d5f',
                    600: '#d62853',
                    700: '#b41c45',
                    800: '#971a40',
                    900: '#811a3d',
                    950: '#48091d',
                },
            },
            fontFamily: {
                sans: ['figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
