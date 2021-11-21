<template>
  <div>
    <section id="homepageHero2" class="bg-primary bg-hero-pattern">
      <Herosite class="md:container md:mx-auto lg:space-x-2" />
    </section>

    <section id="content" class="md:container md:mx-auto mb-8">
      <div class="m-2">
        <div v-if="$fetchState.pending">
          <Loader />
        </div>

        <p v-else-if="$fetchState.error">
          An error occurred :(
        </p>

        <div v-else>
          <div class="flex flex-wrap justify-center ">
            <UserCard
              v-for="(user, index) in users.items().slice(0,12)"
              :key="`user-${index}`"
              :first-name="user.firstName"
              :last-name="user.lastName"
              :profile-image="user.profileImage"
              :role="user.role"
            />
          </div>
        </div>
      </div>
    </section>
    <div class="bg-primary text-neutral-content">
      <Footer class="md:container md:mx-auto" />
    </div>
  </div>
</template>

<script>
import Herosite from '../components/Site/Hero'
import Footer from '../components/Footer'
import UserCard from '../components/UserCard'
import Loader from '../components/Loader'
export default {
  components: { Loader, UserCard, Herosite, Footer },
  data () {
    return {
      users: []
    }
  },

  async fetch () {
    this.users = await this.$userRepository.all()
  }
}
</script>
