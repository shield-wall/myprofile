<template>
  <nav class="navbar flex text-neutral-content">
    <div class="flex-1">
      <Logo />
    </div>

    <div class="flex-none">
      <NuxtLink to="/login">
        <button class="btn btn-primary">
          Entrar
        </button>
      </NuxtLink>
    </div>
    <div class="flex-none">
      <div class="avatar">
        <div class="rounded-full w-10 h-10 m-1">
          <img src="https://i.pravatar.cc/500?img=32">
        </div>
      </div>
    </div>
  </nav>
</template>
<script>
import Logo from './Logo'
export default {
  components: { Logo }
}
</script>
