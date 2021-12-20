<template>
  <CardFluid class="bg-accent -space-y-20">
    <CoverPicture id="cardPicture__coverPicture" :alt="coverAlt" :path="cover" />
    <div class="flex flex-col items-center p-8">
      <ProfilePicture id="cardPicture__profilePicture" :alt="profileAlt" :path="profile" class="w-2/4 bg-accent p-1" />
      <div id="cardPicture__slotContent">
        <slot />
      </div>
    </div>
  </CardFluid>
</template>
<script>
import CardFluid from '../Frames/CardFluid'
import CoverPicture from './CoverPicture'
import ProfilePicture from './ProfilePicture'
export default {
  components: { ProfilePicture, CoverPicture, CardFluid },
  props: {
    cover: { type: String, required: true },
    profile: { type: String, required: true },
    coverAlt: { type: String, required: false, default: 'Background image.' },
    profileAlt: { type: String, required: false, default: 'Profile image.' }
  }
}
</script>
