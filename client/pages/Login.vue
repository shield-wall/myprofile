<template>
  <div class="flex flex-col justify-center items-center min-h-screen bg-primary text-center">
      <NuxtLink to="/" class="text-accent text-4xl font-bold m-10">
        My Profile
      </NuxtLink>
      <div class="card bg-accent rounded-3xl shadow-2xl w-11/12 md:w-3/6 lg:w-80">
        <div class="card-body">

          <h1 class="text-3xl font-bold">Login</h1>
          <form class="form-control">
            <label class="label">
              <span class="label-text">E-mail</span>
            </label>
            <input type="text" placeholder="Digite seu e-mail" class="input input-bordered">

            <label class="label">
              <span class="label-text">Senha</span>
            </label>
            <input type="password" placeholder="Digite sua senha" class="input input-bordered">

            <input type="button" value="Entrar" class="btn btn-primary my-6">

            <div class="text-center">
              <NuxtLink to="/register" class="text-sm font-semibold">
                Registrar
              </NuxtLink>
              <NuxtLink to="/resetpassword" class="text-sm font-semibold ml-6">
                Redefinir Senha
              </NuxtLink>
            </div>
          </form>

        </div>
      </div>
  </div>

</template>
