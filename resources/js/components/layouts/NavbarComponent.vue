<template>

  <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <div class="navbar-toggle">
          <button type="button" class="navbar-toggler">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
          </button>
        </div>
        <a class="navbar-brand" :href="'#'+this.navbarTitle">{{ this.navbarTitle }}</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <form>
          <div class="input-group no-border">
            <input type="text" value="" class="form-control" placeholder="Search...">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="now-ui-icons ui-1_zoom-bold"></i>
              </div>
            </div>
          </div>
        </form>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" :href="`${'/profile/'+this.url}`">
              <i class="now-ui-icons users_single-02"></i>
              <p>
                <span class="d-lg-none d-md-block">Account</span>
              </p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>

    import {apiHost} from '../../utils'
    Vue.http = apiHost

    export default {
        data() {
            return {
              token: localStorage.getItem('Token'),
              url: localStorage.getItem('url'),
              navbarTitle: ''
            }
        },
        mounted() {
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            this.getProfile()
        },
        methods: {

            getProfile: function() {
                if(!this.url) this.url = 'bantuan-sosial-kabupaten-kepulauan-anambas'
                axios.post(`/get-header/${this.url}`,{
                    url: window.location.pathname
                })
                .then(resp => {
                    if(resp.data){
                        this.navbarTitle  = resp.data.nav
                    }
                    console.log('title: ',resp.data.nav);
                })

            },

        }
    }
</script>
