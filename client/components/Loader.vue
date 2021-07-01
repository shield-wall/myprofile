<template>
  <div class="columns">
    <div class="column is-half is-offset-one-quarter has-text-centered">
      <div class="fa-3x">
        <fa-icon :icon="faCircleNotch" class="fa-spin"  />
      </div>
    </div>
  </div>
</template>

<script>
import { faCircleNotch } from '@fortawesome/free-solid-svg-icons'

export default {
  name: 'Loader',
  computed: {
    faCircleNotch () {
      return faCircleNotch
    }
  },
}
</script>
