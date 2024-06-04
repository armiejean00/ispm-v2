const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    screens: {
      sm: '480px',
      md: '768px',
      lg: '976px',
      xl: '1440px'
    },
    extend: {
      colors: {
        // origin color
        mainBlue: 'hsl(208, 60%, 33%)',

        // saturated colors
        darkOlive: '#2d4706',
        greenLeaf: '#4c6e00',
        congressBlue: '#004786',
        darkRaspberry: '#861c53',
        mulberryWood: '#5c0b30',

        // lighter colors
        greenOnion: '#77a028',
        androidGreen: '#a3cb49',
        cornflowerBlue: '#539fe3',
        cadillacPink: '#e382b5',
        bashfulPink: '#b6598b',

        // technical colors
        dangerRed: '#c73737',
        cautionYellow: '#f8b800',
        safeGreen: '#57b03b',

        // pulling default palette
        emerald: colors.emerald,
        orange: colors.orange,
        yellow: colors.yellow,
      }
    },
  },
  plugins: [],
}
