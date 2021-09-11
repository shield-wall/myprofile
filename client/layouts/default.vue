<template>
  <div>
    <section class="hero min-h-screen" id="homepageHero">
        <HeroSite class="md:container md:mx-auto" />
    </section>

    <section class="md:container md:mx-auto" id="content">
      <Nuxt />
    </section>

    <div class="md:container md:mx-auto">
      <Footer />
    </div>

  </div>
</template>

<script>
import HeroSite from "../components/Site/Hero";
import Footer from "../components/Footer";
export default {
  components: {Footer, HeroSite}
}
</script>
