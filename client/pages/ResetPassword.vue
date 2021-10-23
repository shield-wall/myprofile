<template>
  <div class="flex flex-col justify-center items-center min-h-screen bg-primary ">
    <NuxtLink to="/" class="text-center text-white text-4xl font-bold p-10 cursor-pointer">
      <Logo/>
    </NuxtLink>
    <div class="card p-4">
      <div class="car-body"> 
          <h1 class="text-2xl font-bold text-center">
            Esqueceu sua Senha?
          </h1>
          <p class="text-center">
            Escreva seu email abaixo e enviaremos um link para resetar sua senha!
          </p>
        <div class="form-control p-2">
          <label class="label">
            <span class="label-text">Email</span>
          </label>
          <input placeholder="erison@gmail.com" class="input input-bordered" type="text">
        </div>
        <div class="form-control mt-6">
          <input type="button" value="Clique aqui para enviarmos" class="btn btn-primary">
        </div>
        <div class=" text-center m-2">
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