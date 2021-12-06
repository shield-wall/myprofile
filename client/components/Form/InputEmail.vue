<template>
  <Input
    label="E-mail"
    placeholder="Digite seu e-mail"
    :violations="violations"
    @input="$emit('input', $event)"
  />
</template>
<script lang="ts">
import Input from './Input'
import { ViolationInterface } from '~/exception/contracts/violation.interface'

export default {
  components: { Input },
  props: {
    label: {
      type: String,
      default: 'Senha'
    },
    id: {
      type: String,
      default: 'password'
    },
    violations: {
      type: Array as () => ViolationInterface[],
      require: true,
      default: () => []
    }
  }
}
</script>
