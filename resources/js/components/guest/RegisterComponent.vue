<template>

  <div class="container">
    <div class="row">
      <div class="col-md-10 ml-auto mr-auto">
        <div class="card card-signup">
          <h2 class="card-title text-center">&nbsp;</h2>
          <div class="card-body">
            <div class="row">
              <div class="col-md-5 ml-auto">
                <div class="info info-horizontal">
                  <div class="icon icon-primary">
                    <i class="material-icons">code</i>
                  </div>
                  <div class="description">
                    <h4 class="info-title">Silahkan Isi Form Register</h4>
                  </div>
                </div>
              </div>
              <div class="col-md-5 mr-auto">
                <!-- <form class="form"> -->
                  <div class="form-group has-default">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">face</i>
                        </span>
                      </div>
                      <input v-model="input.name" type="text" class="form-control" placeholder=" Name...">
                    </div>
                  </div>
                  <div class="form-group has-default">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">mail</i>
                        </span>
                      </div>
                      <input v-model="input.email" type="text" class="form-control" placeholder="Email...">
                    </div>
                  </div>
                  <div class="form-group has-default">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                        </span>
                      </div>
                      <input v-model="input.password" type="password" placeholder="Password..." class="form-control">
                    </div>
                  </div>
                  <div class="form-group has-default">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                        </span>
                      </div>
                      <input v-model="input.password_confirm" type="password" placeholder="Ulangi Password..." class="form-control">
                    </div>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" value="" checked="">
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                      I agree to the
                      <a href="#something">terms and conditions</a>.
                    </label>
                  </div>
                  <div class="text-center">
                    <button @click="Register(input)" class="btn btn-primary btn-round mt-4">Register</button>
                  </div>
                <!-- </form> -->
              </div>
            </div>
          </div>
          <h2 class="card-title text-center">&nbsp;</h2>
        </div>
      </div>
    </div>
  </div>


</template>

<script>

    import axios from 'axios'
    export default {
        data(){
            return {
              input: {
                name: '',
                email: '',
                password: '',
                password_confirm: ''
              },
            }
        },
        methods: {
            Register: function(dat){
              axios.post('/register',{
                password: dat.password,
                name: dat.name,
                email: dat.email,
                password_confirmation: dat.password_confirm
              })
              .then(resp => {
                  if(resp.data.error === 1){
                     let error = resp.data.pesan
                     if(error.name){
                       this.$toastr('error', error.name, 'error')
                     }
                     if(error.email){
                       this.$toastr('error', error.email, 'error')
                     }
                     if(error.password){
                       this.$toastr('error', error.password, 'error')
                     }
                  }else{
                    localStorage.setItem('Token', resp.data.token)
                    localStorage.setItem('url', resp.data.url)
                    this.$toastr('success', 'Register Berhasil, Silahkan Login', 'Informasi')
                    setInterval(() => {
                        window.location.href = "/login"
                    }, 1500);
                  }
              }).catch(error => {
                  this.$toastr('error', 'Gagal Register', 'error')
              })
            },

        },
        mounted() {
            // console.log('Component Register mounted.')
        }
    }
</script>
