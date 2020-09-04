<template>
    <div v-if="loading" class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Loading</h5>
            <img v-if="loading" src="../../../assets/img/loading.gif" />
          </div>
        </div>
      </div>
    </div>
    <div v-else class="row">
      <link href="https://cdn.jsdelivr.net/npm/animate.css@3.5.1" rel="stylesheet" type="text/css">
      <div v-show="isLogin" class="col-md-12">
        <transition
          name="custom-classes-transition"
          enter-active-class="animated tada"
          leave-active-class="animated bounceOutRight"
        >
            <div v-show="!tambah" class="card">
              <div class="card-header">
                <h4 class="card-title"> Data Master Program</h4>
              </div>
              <div class="card-body">
                <div class="col-md-2 pl-1 pull-right">
                  <button class="btn btn-primary btn-block form-control active " @click="btnTambah()"><i class="now-ui-icons education_atom"></i> Tambah</button>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>Sumber Dana</th>
                      <th>Uraian</th>
                      <th class="td-actions text-right">Act</th>
                    </thead>
                    <tbody>
                      <tr v-for="(dat, index) in data">
                        <td>{{ dat.sumber }}</td>
                        <td>{{ dat.uraian }}</td>
                        <td class="td-actions text-right">
                          <button @click="btnEdit(dat)" type="button" rel="tooltip" class="btn btn-success btn-link" data-original-title="" title="">
                            <i class="now-ui-icons shopping_tag-content"></i>
                          </button>
                          <button @click="btnDelConfirm(dat)" type="button" rel="tooltip" class="btn btn-danger btn-link" data-original-title="" title="">
                            <i class="now-ui-icons ui-1_simple-remove"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </transition>
        <transition
          name="custom-classes-transition"
          enter-active-class="animated tada"
          leave-active-class="animated bounceOutRight"
        >
            <div v-show="tambah" class="card">
              <div class="card-header">
                <h4 class="card-title"> Tambah Data</h4>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                          <select v-model="input.id_sd" class="form-control custom-select">
                            <option value="0" selected>Pilih Sumber Dana</option>
                            <option v-for="dat in sumberdana" v-bind:value="dat.id">
                              {{ dat.uraian }}
                            </option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8 pr-2">
                      <div class="form-group">
                        <textarea :disabled="formLoading" placeholder="Input uraian ..." rows="4" cols="80" v-model="input.uraian" class="form-control">{{ input.uraian }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 pl-1 pull-right">
                      <button v-show="!edit" :disabled="!validForm ? true : formLoading " class="btn col-md-2 btn-primary btn-block form-control active" @click="TambahData(input)"><i class="now-ui-icons files_single-copy-04"></i> Simpan</button>
                      <button v-show="edit" :disabled="!validForm ? true : formLoading " class="btn col-md-2 btn-primary btn-block form-control active" @click="ActEdit(input)"><i class="now-ui-icons files_single-copy-04"></i> Update</button>
                      <button :disabled="formLoading" class="btn col-md-2 btn-primary btn-block form-control active " @click="btnBack()"><i class="now-ui-icons arrows-1_minimal-left"></i> Kembali</button>
                  </div>
              </div>
            </div>
        </transition>
      </div>


      <div v-if="!isLogin" class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="title">Otoritas Tidak Diizinkan</h5>
            </div>
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
              data: [],
              desa: [],
              sumberdana: [],
              input: {
                uraian: '',
                id_sd: 0
              },
              token: localStorage.getItem('Token'),
              url: localStorage.getItem('url'),
              isLogin: 0,
              loading: false,
              formLoading: false,
              falseLogin : 0,
              edit : false,
              tambah: false

            }
        },
        components: {

        },
        mounted() {
            this.loading = true
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            this.getDatas()
        },
        methods: {

            btnTambah: function(){
                this.input.id_sd = 0
                this.getSumberDana()
                this.tambah = true
            },

            btnBack: function(){
                this.tambah = false
                this.clearForm()
            },

            btnEdit: function(dat){
                this.getSumberDana()
                if(!this.url) this.url = 'bantuan-sosial-kabupaten-kepulauan-anambas'
                axios.get(`${apiHost}data/edit-data-master-program/${dat.id}-${this.url}`)
                .then(resp => {
                    // console.log(resp);
                    if(resp.data){
                        if(resp.data.error){
                            this.$toastr('error', resp.data.pesan , 'Error Information')
                        }else{
                            this.input = resp.data.data
                            this.tambah = true
                            this.edit = true
                        }
                    }
                }).catch(error => {
                    this.$toastr('error', 'Data Tidak Ditemukan', 'Error Information')
                })
            },

            getDatas: function() {
                if(!this.url) this.url = 'bantuan-sosial-kabupaten-kepulauan-anambas'
                axios.get(`${apiHost}data/get-data-master-program/${this.url}`)
                .then(resp => {
                    // console.log(resp);
                    if(resp.data){
                        if(!resp.data.authr){
                            this.isLogin = 0
                        }else{
                            this.data = resp.data.data
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

            TambahData: function(dat) {
                this.formLoading = true
                this.formData = new FormData()
                for( var key in dat ){
                    this.formData.append(key, dat[key])
                }
                axios.post(`${apiHost}data/tambah-data-master-program/${this.url}`, this.formData, {
                    headers: {'Content-Type': 'multipart/form-data'},
                })
                .then(resp => {
                    if(resp.data.error === 1){
                      this.$toastr('error', resp.data.pesan, 'Error Information')
                      this.formLoading = false
                    }else{
                      this.$toastr('success', resp.data.pesan , 'Information')
                      setTimeout(() => {
                          this.tambah = false
                          this.formLoading = false
                          this.clearForm()
                          this.data  = resp.data.data.data
                          // console.log(resp);
                      }, 1500);
                    }
                }).catch(error => {
                    this.formLoading = false
                    this.$toastr('error', 'Gagal Tambah Data', 'Error Information')
                })
            },

            ActEdit: function(dat){
                this.formLoading = true
                this.formData = new FormData()
                for( var key in dat ){
                    this.formData.append(key, dat[key])
                }
                axios.post(`${apiHost}data/edit-data-master-program/${dat.id}-${this.url}`, this.formData, {
                    headers: {'Content-Type': 'multipart/form-data'},
                })
                .then(resp => {
                    if(resp.data.error === 1){
                      this.$toastr('error', resp.data.pesan, 'Error Information')
                      this.formLoading = false
                    }else{
                      this.$toastr('success', resp.data.pesan , 'Information')
                      setTimeout(() => {
                          this.tambah = false
                          this.formLoading = false
                          this.clearForm()
                          this.data  = resp.data.data.data
                      }, 1500);
                    }
                }).catch(error => {
                    this.formLoading = false
                    this.$toastr('error', 'Gagal Edit Data', 'Error Information')
                })
            },

            btnDelConfirm: function(dat) {
                this.$swal({
                  title: 'Konfirmasi',
                  text: 'Apakah ingin menghapus data ini?',
                  showCancelButton: true,
                  confirmButtonText: 'Ya',
                  cancelButtonText: 'No',
                  showCloseButton: true,
                }).then((result) => {
                  if(result.value) {
                    this.actHapusData(dat)
                  } else {
                    this.$toastr('success', 'Data tidak dihapus', 'Informasi')
                  }
                })
            },

            actHapusData: function(dat) {
                this.loading = true
                axios.post(`${apiHost}data/hapus-data-master-program/${this.url}`,{
                    id : dat.id
                })
                .then(resp => {
                    if(resp.data.error == 1){
                      this.loading = false
                      this.$toastr('error', resp.data.pesan , 'Error Information')
                    }else{
                      this.$toastr('success', resp.data.pesan , 'Success Information')
                      setTimeout(() => {
                          this.loading = false
                          this.data  = resp.data.data.data
                      }, 1500)
                    }

                }).catch(error => {
                    this.$toastr('error', 'Gagal Hapus Data', 'Error Information')
                })
            },

            getSumberDana: function() {
                this.input.id_sd = 0
                axios.get(`${apiHost}data/get-data-sumber-dana/${this.url}`)
                .then(resp => {
                    if(resp.data.length){
                        this.sumberdana = resp.data
                    }
                })
            },

            clearForm: function(){
                this.input = {
                    judul: '',
                    uraian: '',
                }
            }

        },

        computed: {
            validForm() {
                return this.input.id_sd != 0 && this.input.uraian != ''
            },
        },
    }
</script>

<style>
.pull-right1 {
  display:flex;
  justify-content:space-between;
  outline: 2px dashed blue;
}

.pull-right {
  display:flex;
  justify-content: flex-end;
  /* outline: 2px deeppink dashed; */
}
/* The container must be positioned relative: */
.custom-select {
  position: relative;
  font-family: Arial;
  padding-left: 10px;
}

.custom-select select {
  display: none; /*hide original SELECT element: */
}

.select-selected {
  background-color: DodgerBlue;
}

/* Style the arrow inside the select element: */
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}

/* Point the arrow upwards when the select box is open (active): */
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}

/* style the items (options), including the selected item: */
.select-items div,.select-selected {
  color: #ffffff;
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
}

/* Style items (options): */
.select-items {
  position: absolute;
  background-color: DodgerBlue;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}

/* Hide the items when the select box is closed: */
.select-hide {
  display: none;
}

.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
}

</style>
