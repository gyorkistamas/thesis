/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
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
                    ...require("daisyui/src/theming/themes")["[data-theme=light]"],
                    "primary": "darkgreen",
                },
                dark: {
                    ...require("daisyui/src/theming/themes")["[data-theme=dark]"],
                    "primary": "darkgreen",
                }
            }
        ],
    },
    plugins: [require("@tailwindcss/typography"), require("daisyui")],
}

