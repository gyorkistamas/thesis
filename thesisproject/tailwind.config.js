/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './vendor/usernotnull/tall-toasts/config/**/*.php',
        './vendor/usernotnull/tall-toasts/resources/views/**/*.blade.php',
    ],
    theme: {
        fontFamily: {
            'serif': ['Roboto', 'ui-serif', 'sans-serif']
        },
        extend: {},
    },
    daisyui: {
        themes: [
            {
                light: {
                    ...require("daisyui/src/theming/themes")["light"],
                    "primary": "darkgreen",
                },
                dark: {
                    ...require("daisyui/src/theming/themes")["dark"],
                    "primary": "darkgreen",
                }
            }
        ],
    },
    plugins: [require("@tailwindcss/typography"), require("daisyui")],
}

