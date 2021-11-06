<template>
  <div class="min-h-screen max-h-md">
    <NavBar />

    <div class="h-full-90 flex items-center justify-center">
      <div class="flex-1 text-center text-accent text-3xl md:text-5xl lg:text-5xl">
        Crie seu currículo em PDF e site pessoal em poucos minutos!

        <div class="block lg:hidden md:hidden mt-5">
          <button class="btn btn-accent btn-wide">
            Cadastrar
          </button>
        </div>
      </div>

      <div class="flex-1 md:block lg:block hidden">
        <div class="flex justify-center">
          <FormRegister />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NavBar from '../NavBar'
import FormRegister from './FormRegister'
export default {
  components: { FormRegister, NavBar }
}
</script>

<style>
.h-full-90 {
  height: 90vh;
}
</style>
