<template>
  <div class="mask mask-hexagon bg-current inline-block p-1">
    <figure class="mask mask-hexagon">
      <img
        :src="providerUrl + path"
        :alt="alt"
        @error="setFallbackImageUrl(type)"
      >
    </figure>
  </div>
</template>

<script>
export default {
  name: 'Picture',
  props: {
    path: { type: String, required: true },
    alt: { type: String, required: true },
    type: { type: String, required: false, default: 'profile' }
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
