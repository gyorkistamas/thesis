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
  plugins: [require("daisyui")],
}

