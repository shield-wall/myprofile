<template>
  <div class="md:flex lg:flex">
    <div class="self-center lg:mr-10">
      <h1 class="text-white mt-28 text-5xl text-center lg:text-left space-x10">
        Crie seu currículo em PDF e site pessoal em poucos minutos!
      </h1>
      <div class="flex justify-center mt-36">
        <button class="btn btn-accent text-black px-32 lg:invisible md:invisible visible">
          Cadastrar
        </button>
      </div>
    </div>

    <div class="card flex-none flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100 lg:visible md:visible invisible">
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
        <div class="form-control">
          <label class="label">
            <span class="label-text">Email</span>
          </label>
          <input placeholder="erison@gmail.com" class="input input-bordered" type="text">
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Senha</span>
          </label>
          <input placeholder="Sua_$enha" class="input input-bordered" type="password">
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Confirme a senha</span>
          </label>
          <input placeholder="Sua_$enha" class="input input-bordered" type="password">
        </div>
        <div class="form-control mt-6">
          <input type="button" value="Cadastrar" class="btn btn-primary">
        </div>
      </div>
    </div>


  </div>
</template>
