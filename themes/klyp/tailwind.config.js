const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["**/*.{php, js}"],
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
      green: colors.emerald,
      purple: colors.violet,
      yellow: colors.amber,
      pink: colors.fuchsia,
    },
    extend: {
      colors: {
        'sage': '#9DA687',
        'stone': '#F5F2EB',
        'concrete': '#A3AAAD',
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

