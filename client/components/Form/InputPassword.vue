<template>
  <div>
    <label class="label">
      <span class="label-text">{{ label }}</span>
    </label>
    <input type="password" placeholder="Digite sua senha" class="input input-bordered w-full">
  </div>
</template>

<script>
export default {
  name: 'InputPassword',
  props: {
    label: {
      type: String,
      default: 'Senha'
    }
  }
}
</script>
