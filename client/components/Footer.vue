<template>
  <div>
    <footer class="p-10 footer">
      <div>
        <fa-icon :icon="faGithubAlt" class="fa-4x"  />
        <p>My profile <fa-icon :icon="faCodeBranch" /> 3.0.0
          <br />Made with <fa-icon :icon="faHeart" /> by Erison Silva
        </p>
      </div>
      <div>
        <span class="text-white	font-bold text-base">Services</span>
        <a class="link link-hover text-gray-300">Branding</a>
        <a class="link link-hover text-gray-300">Design</a>
        <a class="link link-hover text-gray-300">Marketing</a>
        <a class="link link-hover text-gray-300">Advertisement</a>
      </div>
      <div>
        <span class="text-white	font-bold text-base">Company</span>
        <a class="link link-hover text-gray-300	">About us</a>
        <a class="link link-hover text-gray-300	">Contact</a>
        <a class="link link-hover text-gray-300">Jobs</a>
        <a class="link link-hover text-gray-300">Press kit</a>
      </div>
      <div>
        <span class="text-white	font-bold text-base">Legal</span>
        <a class="link link-hover text-gray-300">Terms of use</a>
        <a class="link link-hover text-gray-300">Privacy policy</a>
        <a class="link link-hover text-gray-300">Cookie policy</a>
      </div>
    </footer>
  </div>
</template>

<script>
import { faGithubAlt} from '@fortawesome/free-brands-svg-icons'
import { faHeart, faCodeBranch } from '@fortawesome/free-solid-svg-icons'

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
    }
  },
}
</script>
