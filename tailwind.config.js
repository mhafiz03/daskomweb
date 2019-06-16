module.exports = {
  important: true,
  theme: {

    inset: {
      '0': 0,
      auto: 'auto',
      '1/2': '50%',
    },

    fontFamily: {
      'merri-italic': ['merri-italic'],
      'merri-bold': ['merri-bold'],
      'merri': ['merri-regular'],
      'monda-bold': ['monda-bold'],
      'monda': ['monda-regular'],
      'overpass': ['overpass-regular'],
      'overpass-bold': ['overpass-bold'],
      'overpass-thin': ['overpass-thin'],
      'overpass-italic': ['overpass-italic'],
      'overpass-mono': ['overpass-mono-regular'],
      'overpass-mono-bold': ['overpass-mono-bold'],
      'overpass-mono-thin': ['overpass-mono-thin'],
    },
    
    borderRadius: {
      default: '.25rem',
      'none': '0',
      'sm': '.125rem',
      'lg': '.5rem',
      'full': '9999px',
      'large': '25px',
    },

    inset: {
      '0': 0,
      '5': '5rem',
      auto: 'auto',
      '1/2': '50%',
      '1/4': '25%',
      'minFull': '-100%',
      '36full': 'calc(100% - 9rem)',
    },

    extend: {

      borderWidth: {
        '6': '6px',
      },

      margin: {
        '18': '4.8rem',
      },

      spacing: {
        '34': '8.5rem',
        '36': '9rem',
        '36full': 'calc(100% - 9rem)',
        '24full': 'calc(100% - 6rem)',
      },

      height: {
        '1/4': '25%',
        '1/3': '33.33333%',
        '2/3': '66.66667%',
        '1/2': '50%',
      }
    }
  },
  variants: {
    borderWidth: ['responsive', 'hover', 'focus'],
  },
  plugins: []
}
