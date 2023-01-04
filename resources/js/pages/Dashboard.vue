<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mt-3">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Weekly performance</h5>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item">Action</a>
                  <a href="#" class="dropdown-item">Another action</a>
                  <a href="#" class="dropdown-item">Something else here</a>
                  <a class="dropdown-divider"></a>
                  <a href="#" class="dropdown-item">Separated link</a>
                </div>
              </div>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <p class="text-center">
                  <span>1 Jan {{ new Date().getFullYear() }} - 7 Jan {{  new Date().getFullYear() }} </span>
                </p>

                <div class="chart">
                  <!-- Chart Canvas -->
                  <canvas id="myChart" height="180" style="height: 180px;"></canvas>
                  <!-- <Bar id="myChart" :options="chartOptions" :data="chartData" />
                  {{ weeklydata }}
                  <div v-for="acs in oldacs" :key="acs.id">
                    {{ acs.restartacs }}
                    {{ acs.completedacs }}
                  </div> -->
                </div>
                <!-- /.chart-responsive -->
              </div>
              <!-- /.col -->
            <!-- REmoved div col 4 if needed -->
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
          <div class="card-footer">
           <!-- Card footer row -->
            <!-- /.row -->
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-6 mt-3">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Monthly performance</h5>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item">Action</a>
                  <a href="#" class="dropdown-item">Another action</a>
                  <a href="#" class="dropdown-item">Something else here</a>
                  <a class="dropdown-divider"></a>
                  <a href="#" class="dropdown-item">Separated link</a>
                </div>
              </div>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <p class="text-center">
                  <span>1 Jan {{ new Date().getFullYear()   }} - 31 Dec {{  new Date().getFullYear()   }}</span>
                </p>

                <div class="chart">
                  <!-- Sales Chart Canvas -->
                  <canvas id="monthlyChart" height="180" style="height: 180px;"></canvas>
                  <!-- <Bar id="myChart" :options="chartOptions" :data="chartData" />
                  {{ weeklydata }}
                  <div v-for="acs in oldacs" :key="acs.id">
                    {{ acs.restartacs }}
                    {{ acs.completedacs }}
                  </div> -->
                </div>
                <!-- /.chart-responsive -->
              </div>
              <!-- /.col -->
            <!-- REmoved div col 4 if needed -->
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
          <div class="card-footer">
            <!-- card footer row -->
            <!-- /.row -->
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>

</template>


<script>
import { isProxy, toRaw } from 'vue';
export default {
    data(){
       return{
           weeklyData: [],
           monthlyData: []
       }
   },
   methods: {
            salesChart() {
                let ctx = document.getElementById('myChart').getContext('2d')
                let salesChartData = {
                    datasets: [{
                        label               : 'Completed',
                        backgroundColor     : 'rgba(92, 184, 92,0.9)',
                        borderColor         : 'rgba(92, 184, 92,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(92, 184, 92,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(92, 184, 90,1)',
                        data                :  this.weeklyData[0].allcompleted
                    }, {
                        label               : 'Restart',
                        backgroundColor     : 'rgba(217, 83, 79, 1)',
                        borderColor         : 'rgba(217, 83, 79, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(217, 83, 79, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(217, 83, 77, 1)',
                        data                : this.weeklyData[0].allcompleted
                    }],
                    labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saterday'],
                }
                let salesChartOptions = {
                    maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }],
                        yAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }]
                    }
                }
                new Chart(ctx, {
                    type: 'bar',
                    label: ['Bar Dataset','Bar Dataset'],
                    data: salesChartData,
                    options: salesChartOptions
                })
            },
            monthlyRecapChart() {
                let ctx = document.getElementById('monthlyChart').getContext('2d')
                let salesChartData = {
                    datasets: [{
                        label               : 'Completed',
                        backgroundColor     : 'rgba(92, 184, 92 , 0.2)',
                        borderColor         : 'rgba(92, 184, 92, 0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(92, 184, 92,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(92, 184, 92,1)',
                        fill: true,
                        data                :  this.monthlyData[0].allcompleted
                    }, {
                        label               : 'Restart',
                        backgroundColor     : 'rgba(217, 83, 79, 0.6)',
                        borderColor         : 'rgba(217, 83, 79, 0.8)',
                        pointRadius         : true,
                        pointColor          : 'rgba(217, 83, 79, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(217, 83, 77, 1)',
                        fill: true,
                        data                : this.monthlyData[0].allrestart
                    }],
                    labels: ['Junuary', 'Feburary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November','December',],
                }
                let salesChartOptions = {
                    maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }],
                        yAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }]
                    }
                }
                new Chart(ctx, {
                    type: 'line',
                    data: salesChartData,
                    options: salesChartOptions
                })
            },
        },
    mounted(){
      axios.get('/api/weeklydata')
            .then((response) => {
              this.weeklyData.push(JSON.parse(JSON.stringify(response.data)))
              console.log('ok')
              console.log(this.weeklyData)
              this.salesChart()
              })
            .catch((error) => console.log(error));

            axios.get('/api/monthlydata')
            .then((response) => {
              this.monthlyData.push(JSON.parse(JSON.stringify(response.data)))
              this.monthlyRecapChart()
              console.log(this.monthlyData)
              })
            .catch((error) => console.log(error));
    }
}
</script>
      
<!-- <script>
import { reactive } from 'vue';
import { onBeforeMount, onMounted } from 'vue';
import useActivity from "../services/activityservices";
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {

  setup() {

    const { oldacs, getOldAcs, weeklydata, getWeeklyData } = useActivity();

    const edata = reactive([]);

    const chartData =
    {
      labels: ['Monday', 'Tuesday', 'Wednesday', 'thursday', 'Friday'],
      datasets: [{ label: 'Completed', data: test }, { label: 'Restarted', data: weeklydata }]
    }

    const chartOptions = {
      responsive: true
    }


    onMounted(getOldAcs(), getWeeklyData());
    console.log(test)

    return {
      oldacs,
      getOldAcs,
      weeklydata,
      getWeeklyData,
      chartOptions,
      chartData
    };
  }
}
</script> -->