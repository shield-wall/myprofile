<template>
    <div class="flex flex-col justify-center items-center min-h-screen bg-primary">
        <NuxtLink  to="/" class="text-center text-white text-4xl font-bold p-10 cursor-pointer">
            My Profile
       </NuxtLink>
      <div class="card  flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100 justify-center mb-8">
        <div class="card-body">
           <div>
                <h1 class="text-3xl font-bold text-center mb-4">Registrar</h1>
            </div>
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
            <input type="button" value="Registrar" class="btn btn-primary">
          </div>
           <div class="text-center w-80 py-4">
              <span class="text-sm">Já tem conta?</span>
              <NuxtLink to="/login" class="text-primary text-sm underline font-semibold">Clique aqui!</NuxtLink>
          </div>
        </div>
      </div>
    </div>

</template>