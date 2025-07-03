/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class', // <-- Tambahkan baris ini
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        fontFamily: {
            // Menambahkan font Inter ke dalam konfigurasi
            sans: ['Inter', 'sans-serif'],
        },
    },
  },
  plugins: [],
};