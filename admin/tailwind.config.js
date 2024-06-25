/** @type {import('tailwindcss').Config} */
module.exports = {
  purge: {
    enabled: true,
    content: [
      './admin/*.php',
      './frontend/*.php',
      './inc/*.php'
    ],
  },
  theme: {
    extend: {},
  },
  plugins: [],
}

