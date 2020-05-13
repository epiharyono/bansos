<template>
    <div v-if="loading" class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Loading.....</h5>
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
                <h4 class="card-title"> Data</h4>
              </div>
              <div class="card-body">
                <div class="col-md-2 pl-1 pull-right">
                  <button class="btn btn-primary btn-block form-control active " @click="btnTambah()"><i class="now-ui-icons education_atom"></i> Tambah</button>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Kecamatan</th>
                      <th>Desa/Kelurahan</th>
                      <th>Alamat</th>
                    </thead>
                    <tbody>
                      <tr v-for="(dat, index) in data">
                        <td>{{ dat.nama }}</td>
                        <td>{{ dat.nik }}</td>
                        <td>{{ dat.nm_kec }}</td>
                        <td>{{ dat.nm_desa }}</td>
                        <td>{{ dat.alamat }}</td>
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
                        <input :disabled="formLoading" type="email" class="form-control" v-model="input.nama" placeholder="Nama Penduduk....">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <input :disabled="formLoading" type="text" class="form-control" v-model="input.nik" placeholder="Nomor Induk Kependudukan....">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <input :disabled="formLoading" type="email" class="form-control" v-model="input.tempat" placeholder="Tempat Lahir....">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <input :disabled="formLoading" type="date" class="form-control" v-model="input.tanggal" placeholder="Tanggal Lahir....">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                          <select @change="getDataKab()" v-model="input.id_prov" class="form-control custom-select">
                            <option value="0" selected>Pilih Provinsi</option>
                            <option v-for="datp in provinsi" v-bind:value="datp.id">
                              {{ datp.name }}
                            </option>
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                          <select @change="getDataKec()" v-model="input.id_kab" class="form-control custom-select">
                            <option value="0" selected>Pilih Kabupaten</option>
                            <option v-for="datk in kabupaten" v-bind:value="datk.id">
                              {{ datk.name }}
                            </option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                          <select @change="getDataDesa()" v-model="input.id_kec" class="form-control custom-select">
                            <option value="0" selected>Pilih Kecamatan</option>
                            <option v-for="kec in kecamatan" v-bind:value="kec.id">
                              {{ kec.name }}
                            </option>
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                          <select v-model="input.id_desa" class="form-control custom-select">
                            <option value="0" selected>Pilih Desa / Kelurahan</option>
                            <option v-for="des in desa" v-bind:value="des.id">
                              {{ des.name }}
                            </option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <textarea :disabled="formLoading" placeholder="Input Alamat Sesuai KTP" rows="4" cols="80" v-model="input.alamat" class="form-control">{{ input.alamat }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 pl-1 pull-right">
                      <button :disabled="!validForm ? true : formLoading " class="btn col-md-2 btn-primary btn-block form-control active" @click="TambahData(input)"><i class="now-ui-icons files_single-copy-04"></i> Simpan</button>
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
              profile: {
                name: '',
                email: '',
                about_me: '',
                admin: 0,
              },
              data: [],
              provinsi: [],
              kabupaten: [],
              kecamatan: [],
              desa: [],
              input: {
                nama: '',
                nip: '',
                tempat: '',
                tanggal: '',
                alamat: '',
                id_prov: 0,
                id_kab: 0,
                id_kec: 0,
                id_desa: 0
              },
              token: localStorage.getItem('Token'),
              url: localStorage.getItem('url'),
              isLogin: 0,
              loading: false,
              formLoading: false,
              falseLogin : 0,
              tempFalse : 1000,
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
                this.tambah = true
                this.input.id_prov = 21
                this.getDataProvinsi()
                this.getDataKab()
                this.getDataKec()
                this.getDataDesa()
            },

            btnBack: function(){
                this.tambah = false
                this.clearForm()
            },

            getDatas: function() {
                if(!this.url) this.url = 'bantuan-sosial-kabupaten-kepulauan-anambas'
                axios.get(`${apiHost}data/get-data-penduduk/${this.url}`)
                .then(resp => {
                    console.log(resp);
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
                axios.post(`${apiHost}data/tambah-data-penduduk/${this.url}`, this.formData, {
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
                          console.log(resp);
                      }, 1500);
                    }
                }).catch(error => {
                    this.$toastr('error', 'Gagal Tambah Data', 'Error Information')
                })

            },

            getDataProvinsi: function() {
                this.input.id_kab = 0
                this.input.id_kec = 0
                this.input.id_desa = 0
                axios.get(`${apiHost}data/get-data-provinsis/${this.url}`)
                .then(resp => {
                    this.provinsi = resp.data
                })
            },

            getDataKab: function() {
                this.input.id_kab = 0
                this.input.id_kec = 0
                this.input.id_desa = 0
                axios.get(`${apiHost}data/get-data-kabupatens/${this.url}?id_prov=${this.input.id_prov}`)
                .then(resp => {
                    this.kabupaten = resp.data
                    this.kecamatan = []
                    this.desa = []
                })
            },

            getDataKec: function() {
                this.input.id_kec = 0
                this.input.id_desa = 0
                axios.get(`${apiHost}data/get-data-kecamatans/${this.url}?id_kab=${this.input.id_kab}`)
                .then(resp => {
                    this.kecamatan = resp.data
                    this.desa = []
                })
            },

            getDataDesa: function() {
                this.input.id_desa = 0
                axios.get(`${apiHost}data/get-data-desas/${this.url}?id_kec=${this.input.id_kec}`)
                .then(resp => {
                    this.desa = resp.data
                })
            },

            clearForm: function(){
                this.input = {
                    nama: '',
                    nik: '',
                    tanggal: '',
                    tempat: '',
                    alamat: '',
                }
            }

        },

        computed: {
            authHeaders () {
              return {
                'Authorization': `Bearer ${this.token}`
              }
            },

            validForm() {
                return this.input.nama != '' && this.input.nik != '' && this.input.alamat != '' && this.input.tempat != '' && this.input.tanggal != '' && this.input.id_prov != '' && this.input.id_kab != '' && this.input.id_kec != '' && this.input.id_desa != ''
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
