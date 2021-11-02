<template>
  <button type="submit" class="btn btn-primary">
    {{ label }}
  </button>
</template>

<script>
export default {
  name: 'Button',
  props: ['label']
}
</script>
