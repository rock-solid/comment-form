/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './admin/*.php',
    './frontend/*.php',
    './inc/*.php'
  ],
  theme: {
    colors: {
      white: {
        '100': '#fff',
      },
      black: {
        '100': '#000',
      },
      green: {
        '100': '#235957',
        '200': '#003535',
      },
      grey: {
        '100': '#cbcbcb',
      },
      transparent: 'transparent',
    },
  },
  plugins: [],
}

