<template>
  <div class="card flex-1 flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100 lg:visible md:visible invisible">
    <div class="card-body">
      <div class="form-control">
        <label class="label">
          <span class="label-text">Nome</span>
        </label>
        <input placeholder="Erison" class="input input-bordered" type="text">
      </div>
      <div class="form-control">
        <label class="label">
          <span class="label-text">Sobrenome</span>
        </label>
        <input placeholder="Silva" class="input input-bordered" type="text">
      </div>
      <InputEmail />
      <InputPassword />
      <InputPassword label="Confirme a senha" />
      <Button label="Cadastrar" class="my-6" />
    </div>
  </div>
</template>
<script>
import InputEmail from '../Form/InputEmail'
import InputPassword from '../Form/InputPassword'
import Button from '../Form/Button'
export default {
  components: { Button, InputPassword, InputEmail }
}
</script>
