<template>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Grafik</h5>
          </div>
          <div class="card-body">
            <line-chart
              v-if="loaded"
              :chartdata="chartdata"
              :options="options"
              :width="700"
              :height="155"
              />

          </div>
        </div>
      </div>
    </div>
</template>

<script>
    import {apiHost} from '../../utils'
    Vue.http = apiHost
    import LineChart from './Chart.vue'
    export default {
       // extends: Line,
       components: { LineChart },
       data: () => ({
         loaded: false,
         options: {
           type: Object,
           default: null
         },
         chartdata: {},
         chartdatax: {
           labels: ['January', 'February'],
           datasets: [
             {
               label: 'Data One',
               backgroundColor: '#f87979',
               data: [40, 20]
             }
           ]
         },

       }),

       mounted() {
             let uri = 'http://localhost:8000/coins';
             let Years = new Array();
             let Labels = new Array();
             let Prices = new Array();
             if(!this.url) this.url = 'bantuan-sosial-kabupaten-kepulauan-anambas'
             axios.get(`${apiHost}guest/get-chart-bansos/${this.url}`).then((response) => {
                let data = response.data;
                if(data) {
                   data.forEach(element => {
                       Years.push(element.id);
                       Labels.push(element.judul);
                       Prices.push(element.id);
                   });

                   this.chartdata = {
                     labels: ['JAN','FEB'],
                     datasets: [
                       {
                         label: 'Bansos',
                          borderColor: '#FC2525',
                          backgroundColor: 'rgba(50, 115, 220, 0.1)',
                         data: Years
                       }
                     ]
                   }
                   this.loaded = true
                 }
                 else {
                    console.log('No data');
                 }
          });
       }
    }
</script>

<style>
  .small {
    max-width: 100px auto;
    margin:  100px;
    height: 420px;
    width: 100px auto;
  }
  #line-chart {
    /* display: block; height: 420px; width: 420px; */
  }
</style>
