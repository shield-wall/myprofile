<template>
  <Input
    label="E-mail"
    placeholder="Digite seu e-mail"
    :violations="violations"
    @input="$emit('input', $event)"
  />
</template>
<script>
import Input from './Input'

export default {
  components: { Input },
  props: ['violations']
}
</script>
