<template>
  <footer class="footer has-background-dark has-text-white is-primary">
    <div class="content has-text-centered">
      <div class="buttons is-centered">
        <div class="">
          <a href="https://www.instagram.com/my.profile.pro/" class="button is-primary is-outlined" target="_blank">
            <fa-icon :icon="faInstagram" class="fa-2x"  />
          </a>
        </div>
        <div>
          <!-- TODO add gitref here-->
          <a href="https://github.com/eerison/myprofile" class="button is-primary is-outlined" target="_blank" title="git ref: ">
            <i class="icon-github fa-2x"></i>
          </a>
        </div>
        <div class="">
          <a href="https://www.jetbrains.com" class="button is-primary is-outlined" target="_blank">
            <span class="icon-jetbrains fa-2x"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span><span class="path14"></span><span class="path15"></span><span class="path16"></span></span>
          </a>
        </div>
        <div class="">
          <a href="https://sentry.io" class="button is-primary is-outlined" target="_blank">
            <i class="icon-sentry fa-2x"></i>
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
import { faInstagram } from '@fortawesome/free-brands-svg-icons'

export default {
  name: 'Loader',
  computed: {
    faInstagram () {
      return faInstagram
    }
  },
}
</script>
