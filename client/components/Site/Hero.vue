<template>
  <div class="min-h-screen max-h-md">
    <NavBar />

    <div class="flex">
      <div class="md:flex-1 lg:flex-1 space-y-9 text-center md:text-left lg:text-left">
        <h1 class="text-white text-3xl md:text-5xl lg:text-5xl">
          Crie seu currículo em PDF e site pessoal em poucos minutos!
        </h1>

        <button class="btn btn-accent btn-wide lg:invisible md:invisible visible">
          Cadastrar
        </button>
      </div>
      <Form />
    </div>
  </div>

</template>

<script>
import Form from "./Form.vue";
import NavBar from "../NavBar";
export default {
  components: {NavBar, Form}
};
</script>
