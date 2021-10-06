<template>
  <div class="md:flex lg:flex">
    <div>
      <h1 class="text-white text-5xl mb-2">
        Crie seu currículo em PDF e site pessoal em poucos minutos!
      </h1>
      <button class="btn btn-accent btn-outline lg:invisible md:invisible visible">
        Cadastrar
      </button>
    </div>

    <div class="card flex-none flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100 lg:visible md:visible invisible">
      <div class="card-body">
        <div class="form-control">
          <label class="label">
            <span class="label-text">Name</span>
          </label>
          <input placeholder="Name" class="input input-bordered" type="text">
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Second Name</span>
          </label>
          <input placeholder="Name" class="input input-bordered" type="text">
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Email</span>
          </label>
          <input placeholder="email" class="input input-bordered" type="text">
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Password</span>
          </label>
          <input placeholder="password" class="input input-bordered" type="password">
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Confirm Password</span>
          </label>
          <input placeholder="password" class="input input-bordered" type="password">
        </div>
        <div class="form-control mt-6">
          <input type="button" value="Login" class="btn btn-primary">
        </div>
      </div>
    </div>


  </div>
</template>
