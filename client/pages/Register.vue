<template>
  <div class="flex flex-col justify-center items-center min-h-screen bg-primary">
    <NuxtLink to="/" class="text-center p-10 cursor-pointer">
      <Logo />
    </NuxtLink>
    <div class="card mb-4">
      <div class="card-body">
          <h1 class="text-3xl font-bold text-center mb-4 mt-4">
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
        <div class="form-control">
          <label class="label">
            <span class="label-text">Email</span>
          </label>
          <input placeholder="erison@gmail.com" class="input input-bordered" type="text">
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Senha</span>
          </label>
          <input placeholder="Sua_$enha" class="input input-bordered" type="password">
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Confirme a senha</span>
          </label>
          <input placeholder="Sua_$enha" class="input input-bordered" type="password">
        </div>
        <div class="form-control mt-6">
          <input type="button" value="Registrar" class="btn btn-primary">
        </div>
        <div class="text-center">
          <span class="text-sm">Já tem conta?</span>
          <NuxtLink to="/login" class="text-primary text-sm underline font-semibold">
            Clique aqui!
          </NuxtLink>
        </div>
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
export default {
  components: { Logo }
}
</script>
