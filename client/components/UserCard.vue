<template>
  <div class="m-2">
    <NuxtLink to="/">
      <div class="rounded-3xl overflow-hidden shadow-xl max-w-xs my-3 bg-gray-700 h-68 min-h-full transform motion-safe:hover:scale-105">
        <Picture
          :path="backgroundImage"
          size="small_background"
          alt="background image"
        />

        <div class="flex flex-wrap justify-center -mt-5">
          <Picture
            :path="profileImage"
            type="profile"
            alt="Profile image"
          />
        </div>

        <div class="flex flex-col text-white text-center font-sans px-3 pb-6 pt-2">
          <h3 class="text-xl leading-8">{{ firstName }} {{ lastName }}</h3>
          <p class="text-base text-gray-200 mt-2">{{ role }}</p>
        </div>
      </div>
    </NuxtLink>
  </div>
</template>

<script>
  import Picture from "./Picture";
  export default {
    name: 'UserCard',
    components: {Picture},
    props: ['slug', 'firstName', 'lastName', 'role', 'profileImage', 'backgroundImage']
  }
</script>
