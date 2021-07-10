<template>
  <div
    class="column is-full-mobile is-half-tablet is-two-quarters-desktop is-one-quarter-widescreen"
    :class="{
      'is-hidden-mobile': index > 3 && responsiveHidden,
      'is-hidden-tablet-only is-hidden-desktop-only': index > 5 && responsiveHidden
    }"
  >
    <NuxtLink to="/">
        <div class="card">
          <div class="card-image">
            <Picture
              :path="backgroundImage"
              size="small_background"
              alt="background image"
            />
          </div>
          <div class="card-content">
            <div class="media">
              <div class="media-left">
                  <Picture
                    :path="profileImage"
                    type="profile"
                    alt="Profile image"
                  />
              </div>
              <div class="media-content">
                <p class="title is-5">{{ firstName }} {{ lastName }}</p>
                <p class="subtitle is-6">{{ role }}</p>
              </div>
            </div>
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
    props: ['index', 'responsiveHidden', 'slug', 'firstName', 'lastName', 'role', 'profileImage', 'backgroundImage']
  }
</script>
