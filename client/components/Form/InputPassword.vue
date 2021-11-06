<template>
  <Input :id="id" :label="label" placeholder="Digite sua senha" type="password" />
</template>

<script>
import Input from './Input'
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
    }
  }
}
</script>
