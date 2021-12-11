<template>
  <div>
    <h1>{{ slug }}</h1>
  </div>
</template>

<script>
export default {
  layout: 'profile',
  asyncData ({ params }) {
    const slug = params.slug

    return { slug }
  }
}
</script>
