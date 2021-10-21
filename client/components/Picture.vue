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
  props: ['path', 'alt', 'size', 'type', 'email'],
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
        return event.target.src = this.providerUrl + this.defaultProfileImage
      }

      event.target.src = this.providerUrl + this.defaultBackgroundImage
    }
  }
}
</script>
