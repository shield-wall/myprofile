<template>
  <div>
    <NavBar class="p-5 shadow bg-accent text-primary" />

    <div class="container space-y-4 mx-auto mt-10 md:p-0 md:flex md:space-x-10 md:space-y-0">

      <!--      col 1-->
      <div class="flex-1 md:w-1/4 space-y-4 md:space-y-10">

        <div class="card shadow bg-white">
          <div class="card-body">
            bb
          </div>
        </div>

        <div class="card shadow bg-white text-lg">
          <div class="card-body">
              <div class="drawer-side">
                <ul class="menu p-4 overflow-y-auto w-80 bg-base-100 text-base-content">
                  <li>
                    <a class="space-x-2">
                      <fa-icon :icon="faHome" />
                      <span>Home</span>
                    </a>
                  </li>
                  <li>
                    <a class="space-x-2">
                      <fa-icon :icon="faBrain" />
                      <span>Skill</span>
                    </a>
                  </li>
                </ul>
              </div>
          </div>
        </div>

      </div>

      <!--      col 2-->
      <div class="md:w-3/4">
        <div class="card shadow bg-white">
          <div class="card-body">
            <Nuxt />
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<style>
:root {
  @apply bg-gray-100
}
</style>

<script>
import NavBar from "../components/NavBar";
import { faHome, faBrain } from '@fortawesome/free-solid-svg-icons'
export default {
  components: {NavBar},
  computed: {
    faHome () {
      return faHome
    },
    faBrain () {
      return faBrain
    },
  }
}
</script>
