<template>
  <form @submit.prevent="onSubmit">
    <CardBox id="card-box">
      <Input id="first-name" label="Nome" placeholder="Seu primeiro nome." />
      <Input id="last-name" label="Sobrenome" placeholder="Seu segundo nome." />
      <InputEmail id="email" :input-data.sync="parentData" />
      <InputPassword />
      <InputPassword id="repeat-password" label="Confirme a senha" />
      <input v-model="email" type="text" label="E-mail 2" class="input input-bordered w-full">
      <Button id="register-button" class="my-6">
        Cadastrar
      </Button>

      <div id="ask-for-login" class="text-center text-sm mt-2">
        <span>Já tem conta?</span>
        <NuxtLink to="/login" class="text-primary underline font-semibold">
          Clique aqui!
        </NuxtLink>
      </div>
    </CardBox>
  </form>
</template>

<script>
import InputEmail from '../Form/InputEmail'
import InputPassword from '../Form/InputPassword'
import Button from '../Form/Button'
import Input from '../Form/Input'
import CardBox from '~/components/Site/CardBox'
import { User } from '~/resources/user'
export default {
  components: { CardBox, Input, Button, InputPassword, InputEmail },
  data () {
    return {
      parentData: 'Jithil',
      email: null
    }
  },
  methods: {
    onSubmit () {
      console.log(this.parentData, this.email)
    }
  }
}
</script>
