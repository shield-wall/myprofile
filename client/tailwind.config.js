module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
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
          'primary': '#941100',
          'primary-focus': '#700e04',
          'primary-content': '#ffffff',
          'secondary': '#797979',
          'secondary-focus': '#5e5e5e',
          'secondary-content': '#ffffff',
          'accent': '#d6d6d6',
          'accent-focus': '#a9a9a9',
          'accent-content': '#ffffff',
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
