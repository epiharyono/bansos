<template>

  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
          <div class="card card-login card-hidden">
            <div class="card-header card-header-rose text-center">
              <h4 class="card-title">Halaman Login</h4>
            </div>
            <div class="card-body ">
              <p class="card-description text-center"></p>
              <span class="bmd-form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">email</i>
                    </span>
                  </div>
                  <input v-bind:disabled="loading" v-model="input.email" type="email" class="form-control" placeholder="Email...">
                </div>
              </span>
              <span class="bmd-form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input v-bind:disabled="loading" v-model="input.password" type="password" class="form-control" placeholder="Password...">
                </div>
              </span>
            </div>
            <div class="card-footer justify-content-center">
              <button v-bind:disabled="loading" @click="Login(input)" class="btn btn-rose btn-link btn-lg">{{ this.text }}</button>
            </div>
          </div>
      </div>



    </div>
  </div>


</template>

<script>

    import axios from 'axios'
    import {apiHost} from '../../utils'
    Vue.http = apiHost

    export default {
        data() {
            return {
              data : [],
              input: {
                email: '',
                password : '',
              },
              loading: false,
              errors: [],
              text: 'Login'
            }
        },
        mounted() {
            // console.log('token: ',localStorage.getItem('Token'));
        },
        props: ['url'],
        computed: {
            validForm() {
                return this.input.awal != '' && this.input.akhir != '';
            },
        },
        methods: {
            Login: function(dat) {
                this.loading = true
                this.text = 'Loading...'
                axios.post(`${apiHost}auth/login}`,{
                    password: dat.password,
                    email: dat.email
                })
                .then(resp => {
                    if(resp.data.data.error === 1){
                      this.$toastr('error', 'Username atau Password Salah', 'Error Information')
                      this.loading = false
                      this.text = 'Login'
                    }else{
                      localStorage.setItem('Token', resp.data.data.token)
                      localStorage.setItem('url', resp.data.data.url)
                      this.$toastr('success', 'Login Sukses ', 'Information')
                      setTimeout(() => {
                          window.location.href = "/"
                      }, 1500);
                    }
                }).catch(error => {
                    this.loading = false
                    this.text = 'Login'
                    this.$toastr('error', 'Username atau Password Salah', 'Error Information')
                })

            }
        }
    }
</script>
