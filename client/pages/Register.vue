<template>
  <div class="flex justify-center items-center min-h-screen bg-primary bg-hero-pattern">
    <div class="flex-1">
      <NuxtLink to="/" class="text-center p-10 cursor-pointer">
        <Logo id="logo" />
      </NuxtLink>

      <FormRegister id="form-register" />
    </div>
  </div>
</template>

<script>
import Logo from '../components/Logo'
import FormRegister from '../components/Site/FormRegister'

export default {
  components: { FormRegister, Logo }
}
</script>
