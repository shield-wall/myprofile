<template>
    
   <div class="flex flex-col min-h-screen bg-primary justify-center items-center mb-18">
       <NuxtLink  to="/" class="text-center text-white text-4xl font-bold p-10 cursor-pointer">
            My Profile
       </NuxtLink>
        
      <div class="flex">
        <div class="flex-shrink-0 py-12 px-12 bg-white rounded-2xl shadow-xl z-20 sm:mr-10 sm:ml-10">
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
                    <NuxtLink   to="/register" class="flex-row justify-center items-center text-center underline m-4 p-2">Registrar</NuxtLink> 
                    <NuxtLink   to="/resetpassword" class="flex-row underline justify-center text-center ">Redefinir Senha</NuxtLink>
            </div>
        </div> 
   </div>
</template>


