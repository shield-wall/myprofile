<template>
  <div>
    <section class="hero min-h-screen items-start" id="homepageHero">
        <HeroSite class="md:container md:mx-auto" />
    </section>

    <section class="md:container md:mx-auto mb-8" id="content">
      <Nuxt />
    </section>

    <div class="bg-primary text-neutral-content">
      <Footer  class="md:container md:mx-auto"/>
    </div>

  </div>
</template>

<style>
#homepageHero {
  background: url("../assets/images/bg-pattern.png"), #1f2937;
  background: url("../assets/images/bg-pattern.png"), -webkit-linear-gradient(to left, #4b5364, #1f2937);
  background: url("../assets/images/bg-pattern.png"), linear-gradient(to left, #4b5364, #1f2937);
}
</style>

<script>
import HeroSite from "../components/Site/Hero";
import Footer from "../components/Footer";
export default {
  components: {Footer, HeroSite}
}
</script>
