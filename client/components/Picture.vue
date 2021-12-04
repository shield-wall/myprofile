<template>
  <figure>
    <img
      :class="type === 'profile' ? '-mt-3 w-24 mask mask mask-hexagon': ''"
      :src="providerUrl + path"
      :alt="alt"
      @error="setFallbackImageUrl(type)"
    >
  </figure>
</template>

<script>
export default {
  name: 'Picture',
  props: {
    path: { type: String, required: false },
    alt: { type: String, required: false },
    type: { type: String, required: false }
  },
  data () {
    return {
      providerUrl: process.env.FILE_PROVIDER.transloadit.host + '/' + process.env.FILE_PROVIDER.transloadit.prefix,
      defaultProfileImage: process.env.IMAGE.default.profile,
      defaultBackgroundImage: process.env.IMAGE.default.background
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
