<template>
    <div class="grid grid-cols-1 lg:grid-cols-2 lg:space-x-64 lg:p-32 sm:grid-cols-1">


      <div class="flex-col hero-content lg:flex-row">
          <div class="flex-grow align-items-center">
              <h1 class="text-white text-center  text-5xl sm:text-5x1 mb-2 p-12">
                Crie seu currículo em PDF e site pessoal em poucos minutos!
              </h1>
                <button class="btn btn-primary mt-6 ml-44 2xl:ml-52 lg:invisible md:visible sm:visible">
                    Cadastrar
                </button>
          </div>
      </div>

         
        <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100 lg:visible md:invisible sm:invisible">
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
