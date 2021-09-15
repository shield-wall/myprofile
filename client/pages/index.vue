<template>
  <div class="m-2">
    <div v-if="$fetchState.pending">
        <Loader />
    </div>

    <p v-else-if="$fetchState.error">An error occurred :(</p>

    <div v-else>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6">
          <UserCard
            v-for="(user, index) in users.items().slice(0,12)"
            :key="`user-${index}`"
            :firstName="user.firstName"
            :lastName="user.lastName"
            :profileImage="user.profileImage"
            :role="user.role"
          />
        </div>
    </div>

  </div>
</template>

<script>
  import UserCard from "../components/UserCard";
  import Loader from "../components/Loader";
  export default {
    components: {Loader, UserCard},
    data () {
      return {
        users: []
      }
    },

    async fetch() {
      this.users = await this.$userRepository.all();
      console.log(this.users.totalItems());
    }
  };
</script>
