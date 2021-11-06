<template>
  <div class="card flex-1 flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
    <div class="card-body">
      <Input id="first-name" label="Nome" placeholder="Seu primeiro nome." />
      <Input id="last-name" label="Sobrenome" placeholder="Seu segundo nome." />
      <InputEmail id="email" />
      <InputPassword />
      <InputPassword id="repeat-password" label="Confirme a senha" />
      <Button id="register-button" label="Cadastrar" class="my-6" />
    </div>
  </div>
</template>

<script>
import InputEmail from '../Form/InputEmail'
import InputPassword from '../Form/InputPassword'
import Button from '../Form/Button'
import Input from '../Form/Input'
export default {
  components: { Input, Button, InputPassword, InputEmail }
}
</script>
