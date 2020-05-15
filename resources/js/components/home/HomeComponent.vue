<template>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Cari Data</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <label>{{ this.pesan }}</label>
                <div class="form-group">
                  <input :disabled="loading" v-on:keyup="keymonitor" v-model="nik" type="text" class="form-control" placeholder="Input Nomor Induk Kependudukan .......">
                </div>
                <img v-if="loading" src="../../../assets/img/loading.gif" />
              </div>
            </div>

            <div v-if="notfound" class="alert alert-primary">
              <button @click="notfound = !notfound" type="button" aria-hidden="true" class="close">
                <i class="now-ui-icons ui-1_simple-remove"></i>
              </button>
              <span><b>Data NIK: {{ this.nik }} yang anda cari tidak ditemukan.</b></span>
            </div>


            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                </div>
              </div>
            </div>

            <div v-if="penerima.length" class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>No</th>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Alamat</th>
                  <th>Jenis</th>
                  <th>Keterangan</th>
                </thead>
                <tbody>
                    <tr v-for="(datp, index) in penerima" >
                      <td class="text-center">{{ datp.no }}</td>
                      <td>{{ datp.nama }}</td>
                      <td>{{ datp.nik }}</td>
                      <td>{{ datp.alamat }}</td>
                      <td>{{ datp.nm_jenis }}</td>
                      <td>{{ datp.keterangan }}</td>
                      <td>{{ datp.file }}</td>
                    </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
</template>

<script>
    import {apiHost} from '../../utils'
    Vue.http = apiHost
    export default {
        data: () => ({
          nik: '',
          pesan: 'Input Nomor Induk Kependudukan',
          loading: false,
          notfound: false,
          penerima: [],

        }),
        mounted() {
            // console.log('Component mounted.')
            if(!this.url) this.url = 'bantuan-sosial-kabupaten-kepulauan-anambas'
        },
        methods: {
            keymonitor: function(event) {
                let panjang = this.nik.length
                this.notfound = false
                this.penerima = []
                if(panjang > 10){
                    this.pesan = 'Input NIK 16 Karakter, Tekan Enter Untuk Melanjutkan'
                    if(panjang > 15){
                        this.pesan = ''
                        this.loading = true

                        axios.post(`${apiHost}guest/cek-penerima-bansos/${this.url}`,{
                            nik: this.nik
                        })
                        .then(resp => {
                            if(resp.data.error){
                                setTimeout(() => {
                                    // this.nik = ''
                                    this.loading = false
                                    this.pesan = 'Input Nomor Induk Kependudukan'
                                    this.notfound = true
                                }, 8500)

                            }else{
                                setTimeout(() => {
                                    this.nik = ''
                                    this.loading = false
                                    this.pesan = ''
                                    this.penerima  = resp.data.data
                                }, 8500)

                            }

                        }).catch(error => {
                            this.$toastr('error', 'Data Tidak Ditemukan', 'Error Information')
                        })
                    }

                }else if(panjang > 8){
                    this.pesan = 'Input NIK 16 Karakter'
                }else{
                    this.pesan = 'Input Nomor Induk Kependudukan'
                }
            }
       }
    }
</script>
