/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js"
  ],
  theme: {
      colors: {
          'pinkLady' : '#F6D5B6',
          'manhattan': '#E9AE8C',
          'vividTangerine': '#FF9376',
          'greyNurse': '#D5D7CC',
          'seaNymph': '#8DAAA6',
          'rollingStone': '#637673',
          'berylGreen': '#BBBDB5'
      },
      fontFamily:{
          'title': ['Itim', 'sans-serif'],
          'text': ['Montserrat', 'cursive']
      },
    extend: {},
  },
  plugins: [
      require('flowbite/plugin')
  ],
}

