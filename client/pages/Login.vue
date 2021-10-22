<template>    
   <div class="flex flex-col justify-center items-center min-h-screen bg-primary">
        <NuxtLink  to="/" class="text-center text-white text-4xl font-bold p-10 cursor-pointer">
            My Profile
       </NuxtLink>
      <div class="flex items-center  min-w-min rounded-3xl shadow-2xl bg-base-100 justify-center mb-8">
        <div class="mx-2">
           <div>
                <h1 class="text-3xl font-bold text-center mb-4 mt-4">Login</h1>
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
         
          <div class="form-control mt-6">
            <input type="button" value="Entrar" class="btn btn-primary">
          </div>
           <div class="text-center w-80 py-4">
            <NuxtLink to="/register" class="text-primary text-sm font-semibold underline m-4">Registrar</NuxtLink>
            <NuxtLink to="/resetpassword" class="text-primary text-sm underline font-semibold">Redefinir Senha</NuxtLink>
          </div>
        </div>
      </div>
    </div>
</template>
