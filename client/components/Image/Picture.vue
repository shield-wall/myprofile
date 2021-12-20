<template>
  <img :src="computedSource" :alt="alt" @error="setFallbackImageUrl(type)">
</template>

<script>
export default {
  name: 'Picture',
  props: {
    path: { type: String, required: true },
    alt: { type: String, required: true }
  },
  data () {
    const transloaditEnv = process.env.FILE_PROVIDER.transloadit
    const imageDefaultEnv = process.env.IMAGE.default

    const data = { prefix: null, host: null, providerUrl: null, defaultProfileImage: null, defaultBackgroundImage: null }

    if (transloaditEnv) {
      data.prefix = transloaditEnv.prefix
      data.host = transloaditEnv.host
      data.providerUrl = transloaditEnv.host + '/' + transloaditEnv.prefix
    }

    if (imageDefaultEnv) {
      data.defaultProfileImage = imageDefaultEnv.profile
      data.defaultBackgroundImage = imageDefaultEnv.background
    }

    return data
  },
  computed: {
    computedSource () {
      const env = process.env.NODE_ENV

      if (env === 'development') {
        return require(`~/assets/images/${this.prefix}${this.path}`)
      }

      return this.providerUrl + this.path
    }
  },
  methods: {
    setFallbackImageUrl (type) {
      if (type === 'profile') {
        event.target.src = this.providerUrl + this.defaultProfileImage
        return
      }

      event.target.src = this.providerUrl + this.defaultBackgroundImage
    }
  }
}
</script>
