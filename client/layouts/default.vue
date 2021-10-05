<template>
  <div>
    <section id="homepageHero">
      <div>
        <NavBar />
      </div>
      <div class="hero min-h-screen max-h-md items-start">
        <HeroSite class="md:container md:mx-auto lg:space-x-2" />
      </div>
    </section>

    <section class="md:container md:mx-auto mb-8" id="content">
      <Nuxt />
    </section>

    <div class="bg-primary text-neutral-content">
      <Footer class="md:container md:mx-auto" />
    </div>
  </div>
</template>

<style>
#homepageHero {
  background: url("../assets/images/bg-pattern.png"), #1f2937;
  background: url("../assets/images/bg-pattern.png"),
    -webkit-linear-gradient(to left, #4b5364, #1f2937);
  background: url("../assets/images/bg-pattern.png"),
    linear-gradient(to left, #4b5364, #1f2937);
}
</style>

<script>
import NavBar from "../components/NavBar.vue";
import HeroSite from "../components/Site/Hero";
import Footer from "../components/Footer";
export default {
  components: { Footer, HeroSite, NavBar}
};
</script>
