<template>
  <div>
    <NavBar class="p-5 shadow bg-accent text-primary" />

    <div class="container space-y-4 mx-auto mt-10 md:p-0 md:flex md:space-x-10 md:space-y-0">
      <!--      col 1-->
      <div class="flex-1 md:w-1/4 space-y-4 md:space-y-10">
        <div class="card shadow bg-white">
          <div class="card-body">
            <div class="flex flex-col items-center space-y-2">
              <Picture alt="" path="/user.jpeg" type="profile" class="w-1/3" />

              <Button class="btn-block btn-outline flex space-x-2">
                <fa-icon :icon="faEye" />
                <span>View public profile</span>
              </Button>
            </div>
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

<script>
import { faHome, faBrain, faEye } from '@fortawesome/free-solid-svg-icons'
import NavBar from '../components/NavBar'
import Button from '../components/Form/Button'
import Picture from '../components/Picture'
export default {
  components: { Picture, Button, NavBar },
  computed: {
    faHome () {
      return faHome
    },
    faBrain () {
      return faBrain
    },
    faEye () {
      return faEye
    }
  }
}
</script>

<style>
:root {
  @apply bg-gray-100
}
</style>
