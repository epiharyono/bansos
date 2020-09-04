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
                <h4 class="card-title">  {{ bansos.judul }}</h4>
              </div>
              <div class="card-body">
                <div class="col-md-2 pl-1 pull-right">
                  <button class="btn btn-primary btn-block form-control active " @click="btnTambah()"><i class="now-ui-icons education_atom"></i> Tambah</button>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>No</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Alamat</th>
                      <th>Jenis</th>
                      <th>Keterangan</th>
                      <th>File</th>
                      <th class="td-actions text-right">Act</th>
                    </thead>
                    <tbody>
                        <tr v-if="loadPenerima">
                            <td colspan="5">Loading....</td>
                        </tr>
                        <tr v-else-if="!penerima.length">
                            <td colspan="5">Belum ada data penerima, silahkan tambah. </td>
                        </tr>
                        <tr v-else v-for="(datp, index) in penerima" >
                          <td class="text-center">{{ datp.no }}</td>
                          <td>{{ datp.nama }}</td>
                          <td>{{ datp.nik }}</td>
                          <td>{{ datp.alamat }}</td>
                          <td>{{ datp.nm_jenis }}</td>
                          <td>{{ datp.keterangan }}</td>
                          <td>{{ datp.file }}</td>
                          <td class="td-actions text-right">
                            <button @click="btnDelPenerimaConfirm(datp)" type="button" rel="tooltip" class="btn btn-danger btn-link" data-original-title="" title="">
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
                          <select v-model="input.id_jenis" class="form-control custom-select">
                            <option value="0" selected>Pilih Jenis Bansos</option>
                            <option v-for="datp in jenis" v-bind:value="datp.id">
                              {{ datp.uraian }}
                            </option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div v-show="input.id_jenis" class="col-md-6 pr-2">
                      <div class="form-group">
                        <input v-on:keyup="cariPenduduk" :disabled="formLoading" type="text" class="form-control" v-model="input.nik" placeholder="Input NIK">
                      </div>
                    </div>
                    <div v-show="input.id_jenis" class="col-md-6 pr-2">
                      <div class="form-group">
                        <input disabled type="text" class="form-control" v-model="input.uang" :placeholder="input.placeNik">
                      </div>
                    </div>
                  </div>
                  <div v-if="input.id_pend" class="row">
                    <div class="col-md-12 pr-2">
                      <div class="form-group">
                        <label v-html="this.input.identitas"></label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div v-if="input.id_jenis == 1" class="col-md-12 pr-2">
                      <div class="form-group">
                        <input :disabled="formLoading" type="number" class="form-control" v-model="input.uang" placeholder="Input Jumlah Uang....">
                      </div>
                    </div>
                    <div class="col-md-12 pr-2">
                      <div class="form-group">
                        <textarea :disabled="formLoading" placeholder="Keterangan ..." rows="4" cols="80" v-model="input.keterangan" class="form-control">{{ input.keterangan }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div  class="col-sm-4">
              				<div class="box ">
              					<input @change="addFile()" type="file" ref="file"  multiple />
              				</div>
                      <div v-show="progressBar" class="progress">
                          <div class="progress-bar " role="progressbar"
                              :style="{width: progressBar + '%'}"
                              :aria-valuenow="progressBar"
                              aria-valuemin="0"
                              aria-valuemax="100">
                            </div>
                      </div>
                  </div>
                  <div class="col-md-12 pl-1 pull-left">
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
<link rel="stylesheet" type="text/css" href="../../../assets/css/inputFile.css" />
<script>
    // import axios from 'axios'
    import {apiHost} from '../../utils'
    Vue.http = apiHost

    export default {
        data() {
            return {
              bansos: {},
              jenis: [],
              penerima: [],
              input: {
                id_jenis: 0,
                id_pend: 0,
                placeNik: 'Input NIK Penerima Bansos....',
                keterangan: '',
                file: ''
              },
              token: localStorage.getItem('Token'),
              url: localStorage.getItem('url'),
              isLogin: 0,
              loading: false,
              formLoading: false,
              loadPenerima : true,
              edit : false,
              tambah: false,
              attachmentName: '',
              attachment: [],
              progressBar: 0,

            }
        },
        props: ['idb'],
        components: {

        },
        mounted() {
            this.loading = true
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            this.getDataBansos()
            if(!this.url) this.url = 'bantuan-sosial-kabupaten-kepulauan-anambas'
        },
        methods: {

            btnTambah: function(){
                this.tambah = true
                this.getJenisBansos()
            },

            btnBack: function(){
                this.tambah = false
                this.clearForm()
            },

            getDataBansos: function(dat){
                axios.get(`${apiHost}data/get-bansos-detail/${this.idb}-${this.url}`)
                .then(resp => {
                    if(resp.data.data){
                        this.bansos  = resp.data.data
                        this.isLogin = resp.data.isLogin
                        this.loading = false
                        this.getDataPenerima()
                    }else{
                        window.location.href = `/data/entri-bansos/${this.url}`
                    }
                }).catch(error => {
                    this.$toastr('error', 'Data Tidak Ditemukan', 'Error Information')
                })
            },

            getDataPenerima: function(){
                axios.get(`${apiHost}data/get-data-penerima-bansos/${this.idb}-${this.url}`)
                .then(resp => {
                    // console.log(resp);
                    if(resp.data.data){
                        this.penerima  = resp.data.data
                    }
                    setTimeout(() => {
                        this.loadPenerima = false
                    }, 1500)
                })
            },

            cariPenduduk: function(event) {
                let panjang = this.input.nik.length
                if(panjang > 10){
                    this.pesan = 'Input NIK 16 Karakter, Tekan Enter Untuk Melanjutkan'
                    if(panjang > 15){ //15
                        this.input.placeNik = 'Loading..... Proses pencarian data'
                        this.formLoading = true

                        axios.get(`${apiHost}data/check-nik/${this.input.nik}-${this.url}`)
                        .then(resp => {
                            // console.log(resp);
                            if(resp.data.status){
                                this.$toastr('success', 'Nama : '+resp.data.nama, ' Information')
                                this.input.id_pend = resp.data.id
                                this.input.identitas = resp.data.identitas
                            }else{
                                this.$toastr('error', resp.data.nama , 'Error Information')
                                this.input.id_pend = 0
                            }
                            this.input.statusNik  = resp.data.status
                            setTimeout(() => {
                                this.formLoading = false
                                this.input.placeNik = resp.data.nama
                            }, 1500)
                        })

                    }

                }else if(panjang > 8){
                    this.input.placeNik = 'Input NIK 16 Karakter'
                }else{
                    this.input.placeNik = 'Input Nomor Induk Kependudukan'
                }
            },

            getDatas: function() {
                if(!this.url) this.url = 'bantuan-sosial-kabupaten-kepulauan-anambas'
                axios.get(`${apiHost}data/get-data-bansos/${this.url}`)
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

            getJenisBansos: function() {
                axios.get(`${apiHost}data/get-jenis-bansos/${this.url}`)
                .then(resp => {
                    // console.log(resp);
                    this.jenis  = resp.data
                })
            },

            addFile: function(){
                for(var i = 0; i < this.$refs.file.files.length; i++ ){
                    let file = this.$refs.file.files[i];
                    // console.log(file);
                    // formData.append('files[' + i + ']', file);
                }
            },

            TambahData: function(dat) {
                this.formLoading = true
                this.formData = new FormData()
                for( var key in dat ){
                    this.formData.append(key, dat[key])
                }
                this.formData.append('id_bansos', this.bansos.id)

                let jmlF = 0
                for(var i = 0; i < this.$refs.file.files.length; i++ ){
                    let file = this.$refs.file.files[i]
                    this.formData.append('files[' + i + ']', file)
                    jmlF++
                }
                this.formData.append('jmlF', jmlF)

                axios.post(`${apiHost}data/tambah-data-penerima-bansos/${this.url}`, this.formData, {
                    headers: {'Content-Type': 'multipart/form-data'},
                    onUploadProgress: function( progressEvent ) {
                        this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) / progressEvent.total))
                    }.bind(this)
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
                          this.penerima  = resp.data.data.data
                          // console.log(resp);
                          this.$refs.file.value  = ''
                          this.progressBar = 0
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
                axios.post(`${apiHost}data/edit-data-bansos/${dat.id}-${this.url}`, this.formData, {
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

            btnDelPenerimaConfirm: function(dat) {
                this.$swal({
                  title: 'Konfirmasi',
                  text: 'Apakah ingin menghapus data ini?',
                  showCancelButton: true,
                  confirmButtonText: 'Ya',
                  cancelButtonText: 'No',
                  showCloseButton: true,
                }).then((result) => {
                  if(result.value) {
                    this.loadPenerima = true
                    axios.post(`${apiHost}data/hapus-data-penerima-bansos/${this.url}`,{
                        id : dat.id
                    })
                    .then(resp => {
                        // console.log(resp);
                        if(resp.data.error == 1){
                          this.loadPenerima = false
                          this.$toastr('error', resp.data.pesan , 'Error Information')
                        }else{
                          this.$toastr('success', resp.data.pesan , 'Success Information')
                          setTimeout(() => {
                              this.loadPenerima = false
                              this.penerima  = resp.data.data.data
                          }, 1500)
                        }

                    }).catch(error => {
                        this.$toastr('error', 'Gagal Hapus Data', 'Error Information')
                    })
                  } else {
                    this.$toastr('success', 'Data tidak dihapus', 'Informasi')
                  }
                })
            },

            actHapusData: function(dat) {
                this.loading = true
                axios.post(`${apiHost}data/hapus-data-bansos/${this.url}`,{
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

            clearForm: function(){
                this.input = {
                    id_jenis: 0,
                    keterangan: '',
                    id_pend: 0
                }
            }

        },

        computed: {
            validForm() {
                return this.input.id_jenis != '' && this.input.keterangan != '' && this.input.id_pend != ''
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

.pull-left {
  display:flex;
  justify-content: flex-start;
  /* outline: 2px deeppink dashed; */
}

.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}



.inputfile-1 + label {
    color: #f1e5e6;
    background-color: #d3394c;
}

.inputfile-1:focus + label,
.inputfile-1.has-focus + label,
.inputfile-1 + label:hover {
    background-color: #722040;
}

.inputfile + label svg {
    width: 1em;
    height: 1em;
    vertical-align: middle;
    fill: currentColor;
    margin-top: -0.25em;
    /* 4px */
    margin-right: 0.25em;
    /* 4px */
}

.js .inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}





</style>
