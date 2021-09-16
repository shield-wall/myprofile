<template>
  <div>
    <footer class="p-10 footer">
      <div>
        <a href="https://github.com/eerison/myprofile" class="link link-hover" target="_blank">
          <fa-icon :icon="faGithubAlt" class="fa-4x"  />
        </a>
        <p>My profile <fa-icon :icon="faCodeBranch" /> 3.0.0
          <br />made with <fa-icon :icon="faHeart" /> by
          <a href="https://github.com/eerison" class="link link-hover" target="_blank">Erison Silva</a>
        </p>
      </div>

      <div class="text-gray-300">
        <span class="text-white	font-bold text-base"><fa-icon :icon="faCoffee"  /> Project</span>
        <a class="link link-hover">Contact</a>
        <a class="link link-hover">Instagram</a>
      </div>

      <div class="text-gray-300">
        <span class="text-white	font-bold text-base"><fa-icon :icon="faHandsHelping"  /> Sponsorship</span>
        <a href="https://transloadit.com" class="link link-hover" target="_blank">Transloadit</a>
        <a href="https://sentry.io" class="link link-hover" target="_blank">Sentry</a>
        <a href="https://www.jetbrains.com" class="link link-hover" target="_blank">Jetbrains</a>
      </div>
    </footer>
  </div>
</template>

<script>
import { faGithubAlt} from '@fortawesome/free-brands-svg-icons'
import { faHeart, faCodeBranch, faHandsHelping, faCoffee } from '@fortawesome/free-solid-svg-icons'

export default {
  name: 'Loader',
  computed: {
    faGithubAlt () {
      return faGithubAlt
    },
    faHeart () {
      return faHeart
    },
    faCodeBranch () {
      return faCodeBranch
    },
    faHandsHelping () {
      return faHandsHelping
    },
    faCoffee () {
      return faCoffee
    }
  },
}
</script>
