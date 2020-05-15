<template>
    <div>
        Chart Option
        <div class="container">
          <line-chart
            v-if="loaded"
            :chartdata="chartdata"
            :options="options"/>
        </div>
    </div>
</template>
<script>
    import {apiHost} from '../../utils'
    Vue.http = apiHost
    import LineChart from './Chart.vue'

    export default {
      name: 'LineChartContainer',
      components: { LineChart },
      data: () => ({
        loaded: false,
        chartdata: {
          type: Object,
          default: null
        },

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

      props: {
        options: {
          type: Object,
          default: null
        }
      },

      async mounted () {
        this.loaded = false
        try {
          if(!this.url) this.url = 'bantuan-sosial-kabupaten-kepulauan-anambas'
          axios.get(`${apiHost}guest/get-chart-bansos/${this.url}`)
          .then(resp => {
              console.log(resp);
              let data = resp.data;
              let Years = new Array();
              let Labels = new Array();
              let Prices = new Array();
              if(data) {
                 data.forEach(element => {
                     Years.push(element.id);
                     Labels.push(element.judul);
                     Prices.push(element.id);
                     console.log('id xx : ',element.id);
                 });

                 // this.datasets = {
                 //    label: Labels,
                 //    backgroundColor: '#FC2525',
                 //    data: Prices
                 // }
                 this.chartdata = ({
                     labels: Years,
                     datasets: [{
                        label: 'Bitcoin',
                        backgroundColor: '#FC2525',
                        data: Prices
                  }]
                  }, {responsive: true, maintainAspectRatio: false})
              }

              this.loaded = true
          })
          this.loaded = true
        } catch (e) {
          console.error(e)
        }
      }
    }
</script>
