<template>


    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
      <div class="container">
        <div class="navbar-wrapper">
          <a class="navbar-brand" href="javascript:;">{{ this.page.navbarbrand }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon icon-bar"></span>
          <span class="navbar-toggler-icon icon-bar"></span>
          <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="material-icons">dashboard</i>
                Dashboard
              </a>
            </li>
            <li class="nav-item " v-bind:class="{ active: page.navRegister, 'text-danger': page.hasError }">
              <a href="/register" class="nav-link">
                <i class="material-icons">person_add</i>
                Register
              </a>
            </li>
            <li class="nav-item" v-bind:class="{ active: page.navLogin, 'text-danger': page.hasError }">
              <a href="/login" class="nav-link">
                <i class="material-icons">fingerprint</i>
                Login
              </a>
            </li>
            <li class="nav-item " style="">
              <a href="#" class="nav-link">
                <i class="material-icons">lock_open</i>
                Lock
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</template>


<script>

    import axios from 'axios'
    var url = window.location.href.split('/').pop();
    export default {
        data() {
            return {
              data : [],
              page: {
                navbarbrand: '',
                navLogin : false,
                navRegister: false,
                hasError: false,
              },
              link: ''
            }
        },
        mounted() {
            console.log("Component Navbar ",url)
            if(url === 'login'){
                this.page.navbarbrand = 'Halaman Login'
                this.page.navLogin = 'active'
            }else if(url === 'register'){
                this.page.navbarbrand = 'Halaman Register'
                this.page.navRegister = 'active'
            }
        },
    }
</script>
