<template>
  <nav class="flex navbar">
    <div class="flex-1">
      <Logo />
    </div>

    <div class="space-x-2">
      <Language />

      <div>
        <NuxtLink to="/login">
          <button class="btn btn-primary">
            Entrar
          </button>
        </NuxtLink>
      </div>

      <div class="hidden md:block">
        <div class="avatar">
          <div class="mask mask-hexagon bg-current inline-block p-0.5">
            <div class="w-12 mask mask-hexagon">
              <img src="https://i.pravatar.cc/500?img=32">
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>
<script>
import Logo from './Logo'
import Language from '~/components/Language'
export default {
  components: { Language, Logo }
}
</script>
