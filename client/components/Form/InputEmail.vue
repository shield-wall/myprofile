<template>
  <Input v-model="inputData" label="E-mail" placeholder="Digite seu e-mail" @keyup="$emit('update:inputData', inputData);" />
</template>
<script>
import Input from './Input'
export default {
  components: { Input },
  props: {
    inputData: String
  }
}
</script>
