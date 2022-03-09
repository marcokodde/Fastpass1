const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                headline: ['Oswald'],
                headline: ['Montserrat'],
            },
        },
        screens: {
            'sm': {'min': '320px', 'max': '567px'},
            // => @media (min-width: 640px and max-width: 767px) { ... }
            'md': {'min': '568px', 'max': '767px'},
            // => @media (min-width: 768px and max-width: 1023px) { ... }
            'lg': {'min': '767px', 'max': '1024px'},
            // => @media (min-width: 1024px and max-width: 1279px) { ... }
            'xl': {'min': '1025px', 'max': '1405px'},
            // => @media (min-width: 1280px and max-width: 1535px) { ... }
            '2xl': {'min': '1406px', 'max': '1805px'},
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
