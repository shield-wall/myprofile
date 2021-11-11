<template>
  <div class="container-middle bg-hero-pattern">
    <NuxtLink to="/" class="m-10">
      <Logo />
    </NuxtLink>

    <CardBox>
      <form class="form-control">
        <InputEmail />
        <InputPassword />
        <Button class="my-4">
          Entrar
        </Button>

        <div class="text-center text-sm font-semibold">
          <NuxtLink to="/register">
            Registrar
          </NuxtLink>
          <NuxtLink to="/resetpassword" class="ml-6">
            Redefinir Senha
          </NuxtLink>
        </div>
      </form>
    </CardBox>
  </div>
</template>

<style>
.container-middle {
  @apply flex flex-col justify-center items-center min-h-screen bg-primary text-center
}
</style>

<script>
import Logo from '../components/Logo'
import InputEmail from '../components/Form/InputEmail'
import InputPassword from '../components/Form/InputPassword'
import Button from '../components/Form/Button'
import CardBox from '../components/Site/CardBox'
export default {
  components: { CardBox, Button, InputPassword, InputEmail, Logo }
}
</script>
