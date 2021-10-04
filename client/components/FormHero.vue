<template>
    <div class="grid grid-cols-1 lg:grid-cols-2 lg:space-x-20 lg:p-24 sm:grid-cols-1">


      <div class="flex-col justify-center hero-content lg:flex-row">
          <div class="flex-grow">
              <h1 class="text-white text-center text-5xl sm:text-5x1 mb-2">
                Crie seu currículo em PDF e site pessoal em poucos minutos!
              </h1>
                <p class="underline text-center text-blue-200 sm:text-lg p-5">
                  Faça seu login para começar
                </p>
          </div>
      </div>

        
        <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
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
                <label class="label">
                  <a href="#" class="label-text-alt">Forgot password?</a>
                </label>
              </div> 
              <div class="form-control">
                <label class="label">
                  <span class="label-text">Confirm Password</span>
                </label> 
                <input placeholder="password" class="input input-bordered" type="password"> 
                <label class="label">
                  <a href="#" class="label-text-alt">Forgot password?</a>
                </label>
              </div> 
              <div class="form-control mt-6">
                <input type="button" value="Login" class="btn btn-primary">
              </div>
            </div>
          </div>  
      

      </div>
</template>
