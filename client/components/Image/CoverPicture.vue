<template>
  <Picture :alt="alt" :path="path" class="object-cover h-32 w-full" />
</template>

<script>
import Picture from './Picture'
export default {
  components: { Picture },
  props: {
    path: { type: String, required: true },
    alt: { type: String, required: true }
  }
}
</script>
