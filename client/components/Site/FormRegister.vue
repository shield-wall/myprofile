<template>
  <CardBox id="card-box">
    <Input id="first-name" label="Nome" placeholder="Seu primeiro nome." />
    <Input id="last-name" label="Sobrenome" placeholder="Seu segundo nome." />
    <InputEmail id="email" />
    <InputPassword />
    <InputPassword id="repeat-password" label="Confirme a senha" />
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
</template>

<script>
import InputEmail from '../Form/InputEmail'
import InputPassword from '../Form/InputPassword'
import Button from '../Form/Button'
import Input from '../Form/Input'
import CardBox from '~/components/Site/CardBox'
export default {
  components: { CardBox, Input, Button, InputPassword, InputEmail }
}
</script>
