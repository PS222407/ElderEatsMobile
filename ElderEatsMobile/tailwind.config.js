const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },       
        colors: {
            'banner': '#519162',
            'label': '#777777',
            'hamburger': '#365F41',
            green : colors.green,
            white : '#ffffff',
            gray : '#cccccc',
            unused : '#aaaaaa'
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
