<template>
  <div class="m-2">
    <div v-if="$fetchState.pending">
        <Loader />
    </div>

    <p v-else-if="$fetchState.error">An error occurred :(</p>

    <div v-else>
        <h3 class="is-size-3-desktop is-size-5-touch is-2 has-text-centered m-4">
          Look some curriculum vitae example
        </h3>
        <div class="columns is-multiline is-mobile is-centered">
          <UserCard v-for="(user, index) in users.items().slice(0,12)" :key="`user-${index}`" :firstName="user.firstName" :last-name="user.lastName" :role="user.role"/>
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
