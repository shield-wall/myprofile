import { defineNuxtConfig } from '@nuxt/bridge'
import i18n from './i18n'

export default defineNuxtConfig({
  // TODO put host and prefix dynamically
  env: {
    FILE_PROVIDER: {
      transloadit: {
        // host: 'https://cdn.myprofile.pro',
        // prefix: 'myprofile-prod',
        host: '/_nuxt/assets/images',
        prefix: 'mock'
      }
    },
    IMAGE: {
      default: {
        profile: '/users/user-image-default.webp',
        // TODO upload the default image to background
        background: '/users/e5d3a8a762db6fa77519789443a99c98/background.webp'
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
      lang: 'pt_BR'
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
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '~/plugins/repositories.js',
    '~/plugins/axios.interceptors.ts'
  ],

  axios: {
    baseURL: process.env.API_BASE_URL || '##API_BASE_URL##'
  },

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/typescript
    '@nuxtjs/tailwindcss',
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
    '@nuxtjs/axios',
    '@nuxtjs/i18n'
  ],
  i18n: {
    locales: [
      {
        code: 'en',
        name: 'English',
        image: '~assets/images/flag/en.webp'
      },
      {
        code: 'pt_BR',
        name: 'Portuguese',
        image: '~assets/images/flag/pt_BR.webp'
      }
    ],
    defaultLocale: 'pt_BR',
    vueI18n: i18n
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  },
  tailwindcss: {
    viewer: false
  },
  // TODO remove this after fix nuxtjs nitro.
  bridge: {
    nitro: false
  }
})
