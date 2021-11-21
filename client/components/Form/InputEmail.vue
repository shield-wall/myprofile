<template>
  <Input label="E-mail" placeholder="Digite seu e-mail" v-on:input="$emit('input', $event)" />
</template>
<script>
import Input from './Input'
export default {
  components: { Input }
}
</script>
