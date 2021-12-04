<template>
  <Input
    :id="id"
    :label="label"
    placeholder="Digite sua senha"
    type="password"
    :violations="violations"
    @input="$emit('input', $event)"
  />
</template>

<script lang="ts">
import Input from './Input'
import { ViolationInterface } from '~/exception/contracts/violation.interface'

export default {
  name: 'InputPassword',
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
      require: true
    }
  }
}
</script>
