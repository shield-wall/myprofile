<template>
  <input type="button" :value="label" class="btn btn-primary">
</template>

<script>
export default {
  name: 'Button',
  props: ['label']
}
</script>
