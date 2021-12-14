<template>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-1">
    <Input label="First Name" violations="" placeholder="First Name" />
    <Input label="Last Name" violations="" placeholder="Last Name" />

    <!--    TODO create a component.-->
    <div class="col-span-2">
      <label class="label">
        <span class="label-text">Summary</span>
      </label>
      <textarea class="textarea textarea-bordered h-24 w-full" placeholder="Summary ..." />
    </div>

    <div class="col-span-2">
      <Button>Update</Button>
    </div>
  </div>
</template>

<script>
import Input from '../../components/Form/Input'
import Button from '../../components/Form/Button'
export default {
  components: { Button, Input },
  layout: 'profile',
  asyncData ({ params }) {
    const slug = params.slug

    return { slug }
  }
}
</script>

<style scoped>
  #content div {
    @apply w-1/2
  }
</style>
