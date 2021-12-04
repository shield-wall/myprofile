<template>
  <div>
    <label class="label">
      <span class="label-text">{{ label }}</span>
    </label>
    <input
      :placeholder="placeholder"
      class="input input-bordered w-full"
      :class="computedClass"
      :type="type"
      @input="$emit('input', $event.target.value)"
    >
    <div class="tracking-wide text-red-500 text-xs mt-1 ml-1">
      <div v-for="violation in violations">
        {{ violation.message }}
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { ViolationInterface } from '~/exception/contracts/violation.interface'

export default {
  name: 'Input',
  props: {
    type: { type: String, default: 'text' },
    placeholder: { type: String, required: true },
    label: { type: String, required: true },
    violations: { type: Array as () => ViolationInterface[], required: true }
  },
  computed: {
    computedClass () {
      if (this.violations.length) {
        return 'input-error'
      }

      return ''
    }
  }
}
</script>
