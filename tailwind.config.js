/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/index.php",
    "./src/pages/**/*.php",
    "./src/*.php"],
  theme: {
    fontFamily: {
      sans: ['andy-bold', 'sans-serif']
    },
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
}
