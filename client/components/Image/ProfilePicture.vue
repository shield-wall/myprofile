<template>
  <div class="mask mask-hexagon bg-current inline-block">
    <figure class="mask mask-hexagon">
      <Picture :alt="alt" :path="path" />
    </figure>
  </div>
</template>

<script>
import Picture from './Picture'
export default {
  name: 'ProfilePicture',
  components: { Picture },
  props: {
    path: { type: String, required: true },
    alt: { type: String, required: true }
  }
}
</script>
