<template>
    <NuxtLink to="/" class="column is-3">
      <div class="card">
        <div class="card-image">
          <figure class="image is-3by1">
            <!-- TODO get image from user, create a default image to user background -->
            <img
              src="https://cdn.myprofile.pro/myprofile-prod/users/e5d3a8a762db6fa77519789443a99c98/background.webp"
              onerror="this.src='https://cdn.myprofile.pro/myprofile-prod/users/user-image-default.webp'"
              alt="Profile image"
            />
          </figure>
        </div>
        <div class="card-content">
          <div class="media">
            <div class="media-left is-overlay pt-4 mt-6 ml-5">
              <figure class="image is-64x64">
                <!-- TODO get image from user, create a default image to user background -->
                <img
                  class="is-rounded"
                  src="https://cdn.myprofile.pro/myprofile-prod/users/e5d3a8a762db6fa77519789443a99c98/profile.webp"
                  onerror="this.src='https://cdn.myprofile.pro/myprofile-prod/users/user-image-default.webp'"
                  alt="Profile image"
                />
              </figure>
            </div>
            <div class="media-content">
              <p class="title is-5">{{ firstName }} {{ lastName }}</p>
              <p class="subtitle is-6">{{ role }}</p>
            </div>
          </div>
        </div>
      </div>
    </NuxtLink>
</template>

<script>
  export default {
    name: 'UserCard',
    props: ['id', 'firstName', 'lastName', 'role']
  }
</script>
