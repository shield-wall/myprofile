<template>
  <figure
    class="image"
    :class="{
      'is-64x64': size === 'small' || !size,
      'is-3by1': size === 'small_background'
    }"
  >
    <img
      :class="type === 'profile' ? 'is-rounded': ''"
      :src="providerUrl + path"
      :alt="alt"
      @error="setFallbackImageUrl(type)"
    />
  </figure>
</template>

<script>
export default {
  name: 'Picture',
  props: ['path', 'alt', 'size', 'type', 'email'],
  data() {
    return {
      providerUrl: process.env.FILE_PROVIDER.transloadit.host + '/' + process.env.FILE_PROVIDER.transloadit.prefix,
      defaultProfileImage: process.env.IMAGE.default.profile,
      defaultBackgroundImage: process.env.IMAGE.default.background
    };
  },
  methods: {
    setFallbackImageUrl(type) {
      if (type === 'profile') {
        return event.target.src = this.providerUrl + this.defaultProfileImage
      }

      event.target.src = this.providerUrl + this.defaultBackgroundImage
    }
  }
}
</script>
