<template>
  <Input label="E-mail" placeholder="Digite seu e-mail" v-model="inputData" @keyup="$emit('update:inputData', inputData);" />
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
