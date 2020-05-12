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
          <li class=" " v-bind:class="{ active: page.active == 'data' }">
            <a :href="`${'/data/entri'+this.url}`">
              <i class="now-ui-icons education_atom"></i>
              <p>Data Entri</p>
            </a>
          </li>
          <li class=" " v-bind:class="{ active: page.active == 'profile' }">
            <a :href="`${'/profile/'+this.url}`">
              <i class="now-ui-icons users_single-02"></i>
              <p>Profile</p>
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
                collapse: '',
              },
            }
        },
        mounted() {
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            this.setActiveNav()
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
                axios.get(`${apiHost}profile/${this.url}`)
                .then(resp => {
                    if(resp.data.data){
                        this.profile = resp.data.data
                    }
                })

            },

        }
    }
</script>
