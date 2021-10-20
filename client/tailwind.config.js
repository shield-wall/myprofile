module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      backgroundImage: {
          'hero-pattern': "url('/img/hero-pattern.png')"
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('daisyui'),
  ],
  mode: 'jit',
  daisyui: {
    themes: [
      {
        'mytheme': {
          'primary': '#3d4451',
          'primary-focus': '#2a2e37',
          'primary-content': '#ffffff',
          'secondary': '#797979',
          'secondary-focus': '#5e5e5e',
          'secondary-content': '#ffffff',
          'accent': '#ffffff',
          'accent-focus': '#a9a9a9',
          'accent-content': '#000000',
          'neutral': '#4b5364',
          'neutral-focus': '#2a2e37',
          'neutral-content': '#ffffff',
          'base-100': '#ffffff',
          'base-200': '#f9fafb',
          'base-300': '#d1d5db',
          'base-content': '#1f2937',
          'info': '#2094f3',
          'success': '#009485',
          'warning': '#ff9900',
          'error': '#ff5724',
        },
      },
    ],
  }
}
