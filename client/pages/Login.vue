<template>
  <div class="container-middle bg-hero-pattern">
    <NuxtLink to="/" class="m-10">
      <Logo />
    </NuxtLink>

    <div class="card">
      <div class="card-body">
        <h1 class="text-3xl font-bold">
          Login
        </h1>

        <form class="form-control">
          <InputEmail />
          <InputPassword />
          <Button label="Entrar" class="my-4" />

          <div class="text-center">
            <NuxtLink to="/register" class="text-sm font-semibold">
              Registrar
            </NuxtLink>
            <NuxtLink to="/resetpassword" class="text-sm font-semibold ml-6">
              Redefinir Senha
            </NuxtLink>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<style>
.card {
  @apply card bg-accent rounded-3xl shadow-2xl w-11/12 md:w-3/6 lg:w-80;
}

.container-middle {
  @apply flex flex-col justify-center items-center min-h-screen bg-primary text-center
}
</style>

<script>
import Logo from '../components/Logo'
import InputEmail from '../components/Form/InputEmail'
import InputPassword from '../components/Form/InputPassword'
import Button from '../components/Form/Button'
export default {
  components: { Button, InputPassword, InputEmail, Logo }
}
</script>
