<template>
  <div class="container-middle bg-hero-pattern">
    <div class="flex-1">
      <NuxtLink to="/" class="text-center text-white text-4xl font-bold p-10 cursor-pointer">
        <Logo />
      </NuxtLink>

      <CardBox>
        <form class="form-control">
          <InputEmail />
          <Button class="my-4">
            Recuperar Senha
          </Button>

          <div>
            <span class="text-sm">Já tem conta?</span>
            <NuxtLink to="/login" class="text-primary text-sm underline font-semibold">
              Clique aqui!
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
import Button from '../components/Form/Button'
import CardBox from '../components/Site/CardBox'
export default {
  components: { CardBox, Logo, InputEmail, Button }
}
</script>

<style>
.container-middle {
  @apply flex justify-center items-center min-h-screen bg-primary text-center
}
</style>
