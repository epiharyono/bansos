<template>
    <div v-if="loading" class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Loading.....</h5>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="row">
      <div v-show="isLogin" class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Data Entri</h5>
          </div>
          <div class="card-body">
            <form>
              <div class="row">
                <div class="col-md-5 pr-1">
                  <div class="form-group">
                    <label>Company (disabled)</label>
                    <input type="text" class="form-control" disabled="" placeholder="Company" value="Creative Code Inc.">
                  </div>
                </div>
                <div class="col-md-3 px-1">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="Username" value="michael23">
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" placeholder="Email">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="Company" value="Mike">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" value="Andrew">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control" placeholder="City" value="Mike">
                  </div>
                </div>
                <div class="col-md-4 px-1">
                  <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control" placeholder="Country" value="Andrew">
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label>Postal Code</label>
                    <input type="number" class="form-control" placeholder="ZIP Code">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>About Me</label>
                    <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div v-show="isLogin" class="col-md-4">
        <div class="card card-user">
          <div class="image">
            <img src="../../../assets/img/bg5.jpg" alt="...">
          </div>
          <div class="card-body">
            <div class="author">
              <a href="#">
                <img class="avatar border-gray" src="../../../assets/img/mike.jpg" alt="...">
                <h5 class="title">Mike Andrew</h5>
              </a>
              <p class="description">
                michael24
              </p>
            </div>
            <p class="description text-center">
              "Lamborghini Mercy <br>
              Your chick she so thirsty <br>
              I'm in that two seat Lambo"
            </p>
          </div>
          <hr>
          <div class="button-container">
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
              <i class="fab fa-facebook-f"></i>
            </button>
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
              <i class="fab fa-twitter"></i>
            </button>
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
              <i class="fab fa-google-plus-g"></i>
            </button>
          </div>
        </div>
      </div>

      <div v-show="!isLogin" class="col-md-6">
        <div class="card card-user">
          <div class="image">
            <img src="../../../assets/img/bg5.jpg" alt="...">
          </div>
          <div class="card-body">
            <div class="author">
              <a href="#">
                <img class="avatar border-gray" src="../../../assets/img/mike.jpg" alt="...">
                <h5 class="title">Silahkan Login</h5>
              </a>
            </div>
            <div class="col-md-12">
                <div class="pl-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input v-bind:disabled="loading" v-model="input.email" type="email" class="form-control" placeholder="Email">
                  </div>
                </div>
                <div class="pl-1">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input v-bind:disabled="loading" v-model="input.password" type="password" class="form-control" placeholder="password">
                  </div>
                </div>
                    <div class="col-md-12 pl-1">
                      <button class="btn btn-primary btn-block form-control active" @click="LoginForm(input)"><i class="now-ui-icons education_atom"></i> Login</button>
                    </div>
            </div>
          </div>
          <hr>
          <div class="button-container">
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
              <i class="fab fa-facebook-f"></i>
            </button>
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
              <i class="fab fa-twitter"></i>
            </button>
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
              <i class="fab fa-google-plus-g"></i>
            </button>
          </div>
        </div>
      </div>
      <div v-show="!isLogin" class="col-md-6">
        <div class="card card-user">
          <div class="image">
            <img src="../../../assets/img/bg5.jpg" alt="...">
          </div>
          <div class="card-body">
            <div class="author">
              <a href="#">
                <img class="avatar border-gray" src="../../../assets/img/mike.jpg" alt="...">
                <h5 class="title">Silahkan Login</h5>
              </a>
            </div>
          </div>
          <hr>
          <div class="button-container">
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
              <i class="fab fa-facebook-f"></i>
            </button>
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
              <i class="fab fa-twitter"></i>
            </button>
            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
              <i class="fab fa-google-plus-g"></i>
            </button>
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
              profile: {
                name: '',
                email: '',
                admin: 0,
              },
              input: {

              },
              token: localStorage.getItem('Token'),
              url: localStorage.getItem('url'),
              isLogin: 0,
              loading: false
            }
        },
        mounted() {
            this.loading = true
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            this.getProfile()
        },
        methods: {
            setActiveNav: function(){
                var pathname = window.location.pathname
                var patharr = pathname.split("/");
                if(patharr.length > 1){
                    if(patharr[1] === '') this.page.active = 'dashboard'
                    else this.page.active = patharr[1]
                    console.log(this.page.active);
                }
            },

            getProfile: function() {
                if(!this.url) this.url = 'bantuan-sosial-kabupaten-kepulauan-anambas'
                axios.get(`${apiHost}profile/get-data/${this.url}`)
                .then(resp => {
                    if(resp.data){
                        this.profile = resp.data.data
                        this.isLogin = 1
                        setTimeout(() => {
                            this.loading = false
                        }, 1500);
                    }else if(!resp.data.isLogin){
                        this.isLogin = 0
                    }
                    console.log(resp);
                })

            },

            LoginForm: function(dat) {
                this.loading = true
                console.log(dat);
                axios.post(`${apiHost}auth/login`,{
                    password: dat.password,
                    email: dat.email
                })
                .then(resp => {
                  console.log(resp);
                    if(resp.data.data.error === 1){
                      this.$toastr('error', 'Username atau Password Salah', 'Error Information')
                      this.loading = false
                    }else{
                      localStorage.setItem('Token', resp.data.data.token)
                      localStorage.setItem('url', resp.data.data.url)
                      this.$toastr('success', 'Login Sukses ', 'Information')
                      setTimeout(() => {
                          this.isLogin = 1
                      }, 1500);
                    }
                }).catch(error => {
                    this.loading = false
                    this.text = 'Login'
                    this.$toastr('error', 'Username atau Password Salah', 'Error Information')
                })

            },

            Logout: function() {
                localStorage.removeItem('Token')
                localStorage.removeItem('url')
                localStorage.removeItem('yasha')
                this.$toastr('success', 'Logout Sukses', 'Information')
                setTimeout(() => {
                    window.location.href = "/login"
                }, 1500)
            }

        }
    }
</script>
