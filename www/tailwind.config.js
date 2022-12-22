// npx tailwindcss-cli -i ./src/input.css -o ./style/tailwind.css
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/*.{html,js,css}"],
  theme: {
    extend: {},
    spacing: {
      '100vh' : '100vh',
    },
  },
  plugins: [],
}