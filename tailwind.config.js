/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/pages/**/*.php",
    "/src/pages/*.php",
  "/public/index.php"],
  theme: {
    fontFamily: {
      sans: ['Andy-Bold', 'sans-serif'],
    },
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
