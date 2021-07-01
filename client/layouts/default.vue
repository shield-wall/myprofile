<template>
  <div>
    <section class="hero is-transparent is-fullheight" id="homepageHero">
      <HeroSite />
    </section>

    <section class="container" id="content">
      <Nuxt />
    </section>

    <Footer class="mt-6"/>
  </div>
</template>

<script>
import HeroSite from "../components/Site/Hero";
import Footer from "../components/Footer";
export default {
  components: {Footer, HeroSite}
}
</script>
