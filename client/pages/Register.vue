<template>
  <div class="flex flex-col justify-center items-center min-h-screen bg-primary">
    <NuxtLink to="/" class="text-center p-10 cursor-pointer">
      <Logo />
    </NuxtLink>
    <div class="card mb-2">
      <div class="card-body">
          <h1 class="text43xl font-bold text-center mb-4 mt-4">
            Registrar
          </h1>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Nome</span>
          </label>
          <input placeholder="Erison" class="input input-bordered" type="text">
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Sobrenome</span>
          </label>
          <input placeholder="Silva" class="input input-bordered" type="text">
        </div>
      <form class="form-control">
        <InputEmail />
        <InputPassword />
        <InputPassword label="Confirme sua senha"/>
        <Button label="Entrar" class="mt-4"/>
        
        <div class="text-center mt-2">
          <span class="text-sm">Já tem conta?</span>
          <NuxtLink to="/login" class="text-primary text-sm underline font-semibold">
            Clique aqui!
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
</style>

<script>
import Logo from '../components/Logo'
import InputEmail from '../components/Form/InputEmail'
import InputPassword from '../components/Form/InputPassword'
import Button from '../components/Form/Button'

export default {
  components: { Logo,InputEmail, InputPassword,Button }
}
</script>
