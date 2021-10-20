<template>
    
   <div class="flex flex-col min-h-screen bg-primary justify-center items-center mb-18">
       <NuxtLink  to="/" class="text-center text-white text-4xl font-bold p-10 cursor-pointer">
            My Profile
       </NuxtLink>
        
      <div class="flex sm:mx-8">
        <div class=" py-12 px-12 bg-white rounded-2xl shadow-xl z-20 sm:mx-8">
            <div>
                <h1 class="text-3xl font-bold text-center mb-4">Login</h1>
        
            </div>
            <div class="space-y-4">
                <label class="label">
                <span class="label-text">Email</span>
                </label>
                <input type="text" placeholder="erison@gmail.com" class="block text-sm py-3 px-4 rounded-lg w-full border outline-none" />
                <label class="label">
                <span class="label-text">Senha</span>
                </label>
                <input type="text" placeholder="Sua_$enha" class="block text-sm py-3 px-4 rounded-lg w-full border outline-none" />
            </div>
                <div class="text-center mt-6">
                    <button class="py-3 w-64 text-xl text-white bg-primary hover:bg-secondary-focus  rounded-2xl m-2">Entrar</button>
                </div>
            <div class="bg-white border border-gray-300 text-center w-80 py-4">
              <NuxtLink to="/register" class="text-primary text-sm font-semibold underline m-4">Registrar</NuxtLink>
              <NuxtLink to="/resetpassword" class="text-primary text-sm underline font-semibold">Redefinir Senha</NuxtLink>
          </div>
            </div>
        </div> 
   </div>
</template>


