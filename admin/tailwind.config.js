/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    '../admin/*.php',
    '../admin/views/*.php'
  ],
  theme: {
    colors: {
      white: {
        '100': '#fff',
        '200': '#fafafa',
      },
      black: {
        '100': '#000',
      },
      green: {
        '100': '#235957',
        '200': '#003535',
        '300': '#def3f2',
      },
      grey: {
        '100': '#cbcbcb',
        '200': '#e7e7e7',
      },
      transparent: 'transparent',
    },
    fontSize: {
      'xs': '12px',
      'sm': '14px',
      'base': '16px',
      'lg': '18px',
      '2lg': '20px',
      '3lg': '22px',
      'xl': '32px',
    },
    extend: {
      borderWidth: {
        '3': '3px',
      },
    },
  },
  plugins: [],
};

