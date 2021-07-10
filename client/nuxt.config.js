export default {
  //TODO put host and prefix dynamically
  env: {
    FILE_PROVIDER: {
      'transloadit': {
        'host' : 'https://cdn.myprofile.pro',
        'prefix': 'myprofile-prod',
      },
    },
    IMAGE: {
      'default': {
        'profile': '/users/user-image-default.webp',
        //TODO upload the default image to background
        'background': '/users/e5d3a8a762db6fa77519789443a99c98/background.webp',
      }
    }
  },
  // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: false,

  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'My profile',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    'bulma',
    '@assets/css/site.scss'
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '~/plugins/repositories.js'
  ],

  axios: {
    baseURL: process.env.API_BASE_URL || '##API_BASE_URL##'
  },

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/typescript
    '@nuxt/typescript-build',
    ['@nuxtjs/fontawesome', {
      component: 'Fa',
      suffix: true,
      icons: {
        solid: ['faCircleNotch'],
        brands: ['faGithub', 'faInstagram']
      }
    }]
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    '@nuxtjs/axios'
  ],

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  }
}
