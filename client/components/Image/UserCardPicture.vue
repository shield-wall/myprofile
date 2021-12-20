<template>
  <CardPicture id="UserCardPicture__cardPicture" :profile="profileImage" cover="/background.jpg" :class="computedClass">
    <div class="flex flex-col text-center space-y-2">
      <h3 id="UserCardPicture__name" class="text-xl">
        {{ firstName }} {{ lastName }}
      </h3>
      <p id="UserCardPicture__role" class="h-10">
        {{ role }}
      </p>
    </div>
  </CardPicture>
</template>

<script>
import CardPicture from './CardPicture'
export default {
  name: 'UserCard',
  components: { CardPicture },
  props: {
    index: { type: Number, required: true },
    firstName: { type: String, required: false, default: '' },
    lastName: { type: String, required: false, default: '' },
    role: { type: String, required: false, default: '' },
    profileImage: { type: String, required: false, default: '' },
    backgroundImage: { type: String, required: false, default: '' }
  },
  computed: {
    computedClass () {
      if (this.index > 7) {
        return 'hidden lg:block'
      }

      if (this.index > 5) {
        return 'hidden md:block lg:block'
      }

      if (this.index > 3) {
        return 'hidden md:block'
      }

      return ''
    }
  }
}
</script>
