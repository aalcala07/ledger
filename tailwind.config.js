const defaultTheme = require('tailwindcss/defaultTheme');

const assetUrl = process.env.NODE_ENV === 'production' ? process.env.MIX_PRODUCTION_ASSET_URL : process.env.MIX_ASSET_URL;

module.exports = {

    purge: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/components/**/*.vue',
      ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
