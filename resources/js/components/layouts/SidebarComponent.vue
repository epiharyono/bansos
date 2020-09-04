<template>

    <div class="sidebar" data-color="orange">
      <!-- data-color="blue | green | orange | red | yellow" -->
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class=" " v-bind:class="{ active: page.active == 'dashboard' }">
            <a href="/">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class=" " v-bind:class="{ active: page.two == 'entri-bansos' }" v-show="isLogin">
            <a :href="`${'/data/entri-bansos/'+this.url}`">
              <i class="now-ui-icons education_atom"></i>
              <p>Data Entri Bansos</p>
            </a>
          </li>
          <li class=" " v-bind:class="{ active: page.two == 'entri-penduduk' }" v-show="isLogin">
            <a :href="`${'/data/entri-penduduk/'+this.url}`">
              <i class="now-ui-icons education_atom"></i>
              <p>Data Entri Penduduk</p>
            </a>
          </li>
          <li class=" " v-bind:class="{ active: page.two == 'entri-master-program' }" v-show="isLogin">
            <a :href="`${'/data/entri-master-program/'+this.url}`">
              <i class="now-ui-icons education_atom"></i>
              <p>Data Program</p>
            </a>
          </li>
          <li class=" " v-bind:class="{ active: page.active == 'profile' }" v-show="isLogin">
            <a :href="`${'/profile/'+this.url}`">
              <i class="now-ui-icons users_single-02"></i>
              <p>Profile</p>
            </a>
          </li>
          <li class=" " v-bind:class="{ active: page.active == 'profile' }" v-show="!isLogin">
            <a :href="`${'/profile/'+this.url}`">
              <i class="now-ui-icons users_single-02"></i>
              <p>Login</p>
            </a>
          </li>
        </ul>
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
              token: localStorage.getItem('Token'),
              url: localStorage.getItem('url'),
              page: {
                active: '',
                two: '',
              },
              isLogin: 0
            }
        },
        mounted() {
            this.url = 'bantuan-sosial-kabupaten-kepulauan-anambas'
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            this.setActiveNav()
            this.chekLogin()
        },
        methods: {
            setActiveNav: function(){
                var pathname = window.location.pathname
                var patharr = pathname.split("/");
                if(patharr.length > 1){
                    if(patharr[1] === '') this.page.active = 'dashboard'
                    else this.page.active = patharr[1]
                    this.page.two = patharr[2]
                    // console.log('tes ',patharr[1]);
                }
            },

            chekLogin: function() {
                if(!this.url) this.url = 'bantuan-sosial-kabupaten-kepulauan-anambas'
                axios.get(`${apiHost}profile/is-login/${this.url}`)
                .then(resp => {
                    if(resp.data){
                        this.isLogin = resp.data.isLogin
                    }
                    console.log(resp);
                })

            },

        }
    }
</script>
