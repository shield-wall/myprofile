<template>
  <div class="container-middle bg-hero-pattern">
    <div class="flex-1">
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
            <NuxtLink to="/reset-password" class="ml-6">
              Redefinir Senha
            </NuxtLink>
          </div>
        </form>
      </CardBox>
    </div>
  </div>
</template>

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

<style>
.container-middle {
  @apply flex justify-center items-center min-h-screen bg-primary text-center
}
</style>
