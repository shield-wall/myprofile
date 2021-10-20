<template>
  
<div class="flex justify-center min-h-screen bg-primary antialiased">  
  <div class="container rounded-2xl sm:mt-40 mt-24 my-auto max-w-md border-2 border-gray-200 p-3 bg-white">
     
    <div class="text-center m-6">
      <h1 class="text-3xl font-semibold text-gray-700">Esqueceu sua senha?</h1>
      <p class="text-gray-500">Escreva seu email abaixo e enviaremos um link para resetar sua senha!</p>
    </div>
    
    <div class="m-6">
      <form class="mb-4">
        <div class="mb-6">
          <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Email</label>
          <input type="email" name="email" id="email" placeholder="erison@gmail.com" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
        </div>
        <div class="mb-6">
          <button type="button" class="w-full px-3 py-4 text-white bg-primary rounded-md hover:bg-secondary-focus focus:outline-none duration-100 ease-in-out">Clique aqui para enviarmos</button>
        </div>
        <p class="text-sm text-center text-gray-400">
          Não tem conta ainda? 
          <NuxtLink to="/register" class="font-semibold text-primary focus:text-indigo-600 focus:outline-none focus:underline">Clique aqui!</NuxtLink>.
        </p>
      </form>
    </div>
  </div>
</div>
      
</template>