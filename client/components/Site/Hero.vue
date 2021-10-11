<template>
  <div>
    <NavBar />
    <div class="hero min-h-screen max-h-md">
      <Form />
    </div>
  </div>
</template>

<script>
import Form from "./Form.vue";
import NavBar from "../NavBar";
export default {
  components: {NavBar, Form}
};
</script>
