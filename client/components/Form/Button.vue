<template>
  <button type="submit" class="btn btn-primary" :class="computedClass">
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    loading: {
      type: Boolean,
      require: true
    }
  },
  computed: {
    computedClass () {
      return this.loading ? 'loading' : ''
    }
  }
}
</script>
