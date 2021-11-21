<template>
  <form @submit.prevent="onSubmit">
    <CardBox id="card-box">
      <Input id="first-name" label="Nome" placeholder="Seu primeiro nome."  v-model="user.firstName"/>
      <Input id="last-name" label="Sobrenome" placeholder="Seu segundo nome." v-model="user.lastName" />
      <InputEmail id="email" v-model="user.email" />
      <InputPassword v-model="user.password" />
      <InputPassword id="repeat-password" label="Confirme a senha" v-model="user.confirmPassword" />
      <Button id="register-button" class="my-6">Cadastrar</Button>

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
  data (): object {
    return {user: new User()};
  },
  methods: {
    onSubmit () {
      console.log(this.user)
    }
  }
}
</script>
