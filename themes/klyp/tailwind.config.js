const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["**/*.{php, js}"],
  safelist: [
    {
      pattern: /(bg|text|px|py|pt|pb|pr|pl)-./,
      variants: ['sm', 'md', 'lg'],
    },
  ],
  theme: {
    fontFamily: {
      sans: ['neue-haas-grotesk-display', 'sans-serif'],
    },
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: '#2A2A2B',
      white: colors.white,
      gray: colors.slate,
    },
    extend: {
      colors: {
        'sage': '#9DA687',
        'stone': '#F5F2EB',
        'concrete': '#A3AAAD',
        'charcoal': '#393A3E',
        'slate': '#2A2A2B',
      },
      typography: {
        DEFAULT: {
          css: {
            h1: {
              fontWeight: 200,
            },
            h2: {
              fontWeight: 200,
            },
            h3: {
              fontWeight: 200,
            },
            h4: {
              fontWeight: 200,
            },
          }
        }
      }
    },
  },
  corePlugins: {
    aspectRatio: false,
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}

