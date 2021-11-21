<template>
  <div>
    <label class="label">
      <span class="label-text">{{ label }}</span>
    </label>
    <input
        :placeholder="placeholder"
        class="input input-bordered w-full"
        :type="type"
        @input="$emit('input', $event.target.value)"
    />
  </div>
</template>

<script>
export default {
  name: 'Input',
  props: {
    type: { type: String, default: 'text' },
    placeholder: { type: String, required: true },
    label: { type: String, required: true }
  }
}
</script>
