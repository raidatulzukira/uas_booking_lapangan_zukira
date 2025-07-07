/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
        colors: {
            'theme-pink': '#f26682',
            'theme-pink-light': '#fed0e7',
            'theme-pink-dark': '#ea3766',
        }
    },
  },
  plugins: [],
}