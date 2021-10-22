<template>
  <div class="flex flex-col justify-center items-center min-h-screen bg-primary ">
        <NuxtLink  to="/" class="text-center text-white text-4xl font-bold p-10 cursor-pointer">
            My Profile
       </NuxtLink>
      <div class="flex items-center min-w-min  rounded-3xl shadow bg-base-100 justify-center mx-8">
        <div class="mx-4 py-4">
           <div>
                <h1 class="text-2xl font-bold text-center mb-4">Esqueceu sua Senha?</h1>
                <p class="text-center"> Escreva seu email abaixo e enviaremos um link para resetar sua senha!</p>
            </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Email</span>
            </label>
            <input placeholder="erison@gmail.com" class="input input-bordered" type="text">
          </div>
          <div class="form-control mt-6">
            <input type="button" value="Clique aqui para enviarmos" class="btn btn-primary">
          </div>
           <div class=" text-center m-2">
              <span class="text-sm">Já tem conta?</span>
              <NuxtLink to="/login" class="text-primary text-sm underline font-semibold">Clique aqui!</NuxtLink>
          </div>
        </div>
      </div>
    </div>     
</template>

