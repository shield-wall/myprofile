<template>
  <div class="flex space-x-2">
    <NuxtLink v-for="locale in availableLocales" :key="locale.code" :to="switchLocalePath(locale.code)">
      <div class="language border-current" :class="currentLocale === locale.code ? 'border-2': ''">
        <img :src="require(`~/assets/images/flag/${locale.code}.webp`)">
      </div>
    </NuxtLink>
  </div>
</template>

<script>
export default {
  computed: {
    availableLocales () {
      return this.$i18n.locales
    },
    currentLocale () {
      return this.$i18n.locale
    }
  }
}
</script>

<style scoped>
.language{
  @apply w-10 rounded-full
}
</style>
