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
          <ProfilePicture alt="User profile picture." path="/user.jpeg" class="w-12 p-0.5" />
        </div>
      </div>
    </div>
  </nav>
</template>
<script>
import Logo from './Logo'
import Language from '~/components/Language'
import ProfilePicture from '~/components/Image/ProfilePicture'
export default {
  components: { ProfilePicture, Language, Logo }
}
</script>
