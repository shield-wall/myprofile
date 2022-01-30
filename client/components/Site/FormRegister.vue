<template>
  <form @submit.prevent="onSubmit">
    <CardBox id="card-box">
      <Input
        id="first-name"
        v-model="user.firstName"
        label="Nome"
        placeholder="Seu primeiro nome."
        :violations="constraint.getViolationsBy('firstName')"
      />

      <Input
        id="last-name"
        v-model="user.lastName"
        label="Sobrenome"
        placeholder="Seu segundo nome."
        :violations="constraint.getViolationsBy('lastName')"
      />

      <InputEmail
        id="email"
        v-model="user.email"
        :violations="constraint.getViolationsBy('email')"
      />

      <InputPassword
        v-model="user.password"
        :violations="constraint.getViolationsBy('password')"
      />

      <Button id="register-button" class="my-6" :loading="loading">
        {{ $t('register') }}
      </Button>

      <div id="ask-for-login" class="text-center text-sm mt-2">
        <span>Já tem conta?</span>
        <NuxtLink :to="localePath('/login')" class="text-primary underline font-semibold">
          Entrar
        </NuxtLink>
      </div>
    </CardBox>
  </form>
</template>

<script>
import InputEmail from '../Form/InputEmail'
import InputPassword from '../Form/InputPassword'
import Button from '../Form/Button'
import Input from '../Form/Input'
import CardBox from '~/components/Site/CardBox'
import { ConstraintViolationListException } from '~/exception/constraint-violation-list.exception'
import { UserRegister } from '~/resources/user.register'
export default {
  components: { CardBox, Input, Button, InputPassword, InputEmail },
  data () {
    return {
      user: new UserRegister(),
      constraint: new ConstraintViolationListException(),
      loading: false
    }
  },
  methods: {
    async onSubmit () {
      try {
        this.loading = true
        await this.$userRepository.save(this.user)
        this.loading = false
      } catch (constraint) {
        this.constraint = constraint
        this.loading = false
      }
    }
  }
}
</script>
