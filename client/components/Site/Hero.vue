<template>
  <div>
    <NavBar />
    <div class="hero min-h-screen max-h-md">
      <FormHero />
    </div>
  </div>
</template>

<script>
import FormHero from "../FormHero.vue";
import NavBar from "../NavBar";
export default {
  components: {NavBar, FormHero}
};
</script>
