<template>
  <div>
    slug 2
    <h1>{{ this.slug }}</h1>
  </div>
</template>

<script>
import NavBar from "../../components/NavBar";
export default {
  layout: 'profile',
  components: {NavBar},
  async asyncData({params}) {
    const slug = params.slug

    return { slug }
  }
}
</script>
