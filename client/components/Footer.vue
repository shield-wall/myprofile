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
        <span class="footer-title">Services</span>
        <a class="link link-hover">Branding</a>
        <a class="link link-hover">Design</a>
        <a class="link link-hover">Marketing</a>
        <a class="link link-hover">Advertisement</a>
      </div>
      <div>
        <span class="footer-title">Company</span>
        <a class="link link-hover">About us</a>
        <a class="link link-hover">Contact</a>
        <a class="link link-hover">Jobs</a>
        <a class="link link-hover">Press kit</a>
      </div>
      <div>
        <span class="footer-title">Legal</span>
        <a class="link link-hover">Terms of use</a>
        <a class="link link-hover">Privacy policy</a>
        <a class="link link-hover">Cookie policy</a>
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
