<template>
  <div class="min-h-screen max-h-md">
    <NavBar />

    <div class="h-full-90 flex items-center justify-center text-white">

        <div class="flex-1 text-center text-3xl md:text-5xl lg:text-5xl">
          Crie seu currículo em PDF e site pessoal em poucos minutos!

          <div class="block">
            <button class="btn btn-accent mt-5 btn-wide lg:invisible md:invisible visible">
              Cadastrar
            </button>
          </div>
        </div>

        <div class="flex-1 md:block lg:block hidden">
          <div class="flex justify-center">
            <Form />
          </div>
        </div>
    </div>
  </div>
</template>

<script>
import NavBar from '../NavBar'
import Form from './Form.vue'
export default {
  components: { NavBar, Form }
}
</script>

<style>
.h-full-90 {
  height: 90vh;
}
</style>
