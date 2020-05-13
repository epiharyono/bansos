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
            <h5 class="title">Edit Profile</h5>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Email</label>
                    <input :disabled="formLoading" type="email" class="form-control" v-model="profile.email" placeholder="Email....">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>Nama</label>
                    <input :disabled="formLoading" type="text" class="form-control" v-model="profile.name" placeholder="Name....">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>About Me</label>
                    <textarea :disabled="formLoading" placeholder="About Me" rows="4" cols="80" v-model="profile.about_me" class="form-control">{{ this.profile.about_me }}</textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-12 pl-1">
                <button :disabled="!validFormProfile ? true : formLoading " class="btn btn-primary btn-block form-control active" @click="EditProfile(profile)"><i class="now-ui-icons files_single-copy-04"></i> Edit Profile</button>
              </div>
          </div>
        </div>



        <div class="card">
          <div class="card-header">
            <h5 class="title">Edit Password</h5>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-md-12 pr-1">
                  <div class="form-group">
                    <label>Password Lama</label>
                    <input :disabled="formLoading" type="password" class="form-control" v-model="pass.old">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 pr-1">
                  <div class="form-group">
                    <label>Password Baru</label>
                    <input :disabled="formLoading" type="password" class="form-control" v-model="pass.new">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 pr-1">
                  <div class="form-group">
                    <label>Confirm Password Baru</label>
                    <input :disabled="formLoading" type="password" class="form-control" v-model="pass.conf">
                  </div>
                </div>
              </div>
              <div class="col-md-12 pl-1">
                <button :disabled="!validFormPassw ? true : formLoading " class="btn btn-primary btn-block form-control active" @click="EditPassword(pass)"><i class="now-ui-icons files_single-copy-04"></i> Ganti Password</button>
              </div>
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
                <h5 class="title">{{ this.profile.name }}</h5>
              </a>
              <p class="description">{{ this.profile.email }}</p>
            </div>
            <p class="description text-center">{{ this.profile.about_me }}</p>
          </div>
          <div class="col-md-12 pl-1">
            <button :disabled="loading?true: formLoading " class="btn btn-primary btn-block form-control active" @click="Logout()"><i class="now-ui-icons media-1_button-power"></i> Logout</button>
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
                    <input v-bind:disabled="formLoading" v-model="input.email" type="email" class="form-control" placeholder="Email">
                  </div>
                </div>
                <div class="pl-1">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input v-bind:disabled="formLoading" v-model="input.password" type="password" class="form-control" placeholder="password">
                  </div>
                </div>
                <div class="col-md-12 pl-1">
                  <button :disabled="formLoading" class="btn btn-primary btn-block form-control active" @click="LoginForm(input)"><i class="now-ui-icons education_atom"></i> Login</button>
                  <span v-show="formLoading" >Ulangi Setelah  {{ falseLogin / 1000 }} detik</span>
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
    // import axios from 'axios'
    import {apiHost} from '../../utils'
    Vue.http = apiHost

    export default {
        data() {
            return {
              profile: {
                name: '',
                email: '',
                about_me: '',
                admin: 0,
              },
              input: {

              },
              pass: {
                old: 'password lama',
                new: 'passwordbaru',
                conf: 'passwordbaru'
              },
              token: localStorage.getItem('Token'),
              url: localStorage.getItem('url'),
              isLogin: 0,
              loading: false,
              formLoading: false,
              falseLogin : 0,
              tempFalse : 1000

            }
        },
        mounted() {
            this.loading = true
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            this.getProfile()
        },
        methods: {

            getProfile: function() {
                if(!this.url) this.url = 'bantuan-sosial-kabupaten-kepulauan-anambas'
                axios.get(`${apiHost}profile/get-data/${this.url}`)
                .then(resp => {
                    if(resp.data){
                        if(!resp.data.isLogin){
                            this.isLogin = 0
                        }else{
                            this.profile = resp.data
                            this.isLogin = 1
                        }
                        this.formLoading = true
                        setTimeout(() => {
                            this.loading = false
                            this.formLoading = false
                        }, 1500)
                    }
                })

            },

            LoginForm: function(dat) {
                this.formLoading = true
                axios.post(`${apiHost}auth/login`,{
                    password: dat.password,
                    email: dat.email
                })
                .then(resp => {
                    if(resp.data.data.error === 1){
                      this.$toastr('error', 'Username atau Password Salah', 'Error Information')
                      setTimeout(() => {
                          this.formLoading = false
                      }, 2500)
                    }else{
                      localStorage.setItem('Token', resp.data.data.token)
                      localStorage.setItem('url', resp.data.data.url)
                      this.$toastr('success', 'Login Sukses x', 'Information')
                      setTimeout(() => {
                          this.getProfile()
                          this.isLogin = 1
                          this.formLoading = false
                      }, 500);
                    }
                }).catch(error => {
                    this.tempFalse = this.tempFalse * 2
                    this.falseLogin = this.tempFalse
                    setTimeout(() => {
                        this.formLoading = false
                    }, this.falseLogin)
                    this.countDownTimer()
                    this.$toastr('error', 'Username atau Password Salahx', 'Error Information')
                })

            },

            countDownTimer() {
                if(this.falseLogin > 0) {
                    setTimeout(() => {
                        this.falseLogin -= 1000
                        this.countDownTimer()
                    }, 1000)
                }
            },

            EditProfile: function(dat) {
                this.formLoading = true
                this.formData = new FormData()
                for( var key in dat ){
                    this.formData.append(key, dat[key])
                }
                axios.post(`${apiHost}profile/edit-data/${this.url}`, this.formData, {
                    headers: {'Content-Type': 'multipart/form-data'},
                })
                .then(resp => {
                    if(resp.data.error === 1){
                      this.$toastr('error', 'Gagal Ganti Profile', 'Error Information')
                      this.formLoading = false
                    }else{
                      this.$toastr('success', resp.data.pesan , 'Information')
                      setInterval(() => {
                          this.formLoading = false
                      }, 1500);
                    }
                }).catch(error => {
                    this.$toastr('error', 'Gagal Ganti Profile', 'Error Information')
                })

            },

            EditPassword: function(dat) {
                this.formLoading = true
                this.formData = new FormData()
                for( var key in dat ){
                    this.formData.append(key, dat[key])
                }
                axios.post(`${apiHost}profile/update-passwd/${this.url}`, this.formData, {
                    headers: {'Content-Type': 'multipart/form-data'},
                })
                .then(resp => {
                    console.log(resp);
                    if(resp.data.error === 1){
                      this.$toastr('error', resp.data.pesan , 'Error Information')
                      this.formLoading = false
                    }else{
                      this.$toastr('success', resp.data.pesan , 'Information')
                      setTimeout(() => {
                          this.formLoading = false
                      }, 1500);
                    }
                }).catch(error => {
                    this.$toastr('error', 'Gagal Update Password', 'Error Information')
                })

            },

            Logout: function() {
                this.loading = true
                localStorage.removeItem('Token')
                localStorage.removeItem('url')
                localStorage.removeItem('yasha')
                this.$toastr('success', 'Logout Sukses', 'Information')
                setTimeout(() => {
                    this.isLogin = 0
                    this.loading = false
                }, 1500)
            }

        },

        computed: {
            validFormPassw() {
                return this.pass.old != '' && this.pass.new != '' && this.pass.conf != '' && this.pass.new == this.pass.conf
            },
            validFormProfile() {
                return this.profile.name != '' && this.profile.email != ''
            },
        },
    }
</script>
