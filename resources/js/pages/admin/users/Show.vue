<template>
  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="/img/user/default-user.png"
                alt="User profile picture" />
            </div>

            <h3 class="profile-username text-center">{{ user.name }}</h3>

            <div v-for="role in user.roles" :key="role.id">
              <p v-if="role.name == 'super-admin'" class="text-muted text-center">User</p>
            </div>
            <div v-for="role in user.roles" :key="role.id">
              <p v-if="role.name != 'super-admin'" class="text-muted text-center">{{ role.name }}</p>
            </div>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>{{ user.email }}</b>
              </li>
              <!-- <li class="list-group-item">
                  <b>Following</b> <a class="float-right">543</a>
                </li> -->
            </ul>

            <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <!-- About me -->
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
              <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
              <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-center">
                      <span> Proctor Monthly performace </span>
                    </p>
                    <div class="chart">
                      <!-- Chart Canvas -->
                      <canvas id="monthlyChart" height="180" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <div class="col-md-12 mt-5">
                    <p class="text-center">
                      <span> Greet Monthly performace </span>
                    </p>
                    <div class="chart">
                      <!-- Chart Canvas -->
                      <canvas id="monthlyGreetChart" height="180" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <!-- REmoved div col 4 if needed -->
                  <!-- /.col -->
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <!-- Settings part -->
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</template>
  
<script>
import { onMounted } from 'vue';
import useUser from "../../../services/userservices";
import Swal from 'sweetalert2';
import { useAbility } from '@casl/vue';

export default {
  props: ['id'],
  emits: ['role-updated'],
  setup(props, { emit }) {
    const { getUser, user, updateUser, getRoles, roles } = useUser();
    const { can } = useAbility();
    let monthlyData = [];

    onMounted(getUser(props.id));
    onMounted(getRoles);
    onMounted(axios.get('/api/monthlydata').then((response) => {
      monthlyData.push(JSON.parse(JSON.stringify(response.data)))
      monthlyRecapChart();
      monthlyGreetRecapChart();
    })
      .catch((error) => console.log(error)));


    const monthlyRecapChart = () => {
      let ctx = document.getElementById('monthlyChart')
      let salesChartData = {
        datasets: [{
          label: 'Completed',
          backgroundColor: 'rgba(92, 184, 92 , 0.9)',
          borderColor: 'rgba(92, 184, 92, 0.9)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(92, 184, 92,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(92, 184, 92,1)',
          fill: true,
          data: monthlyData[0].allcompleted
        }, {
          label: 'Restart',
          backgroundColor: 'rgba(217, 83, 79, 0.9)',
          borderColor: 'rgba(217, 83, 79, 0.9)',
          pointRadius: true,
          pointColor: 'rgba(217, 83, 79, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(217, 83, 77, 1)',
          fill: true,
          data: monthlyData[0].allrestart
        }],
        labels: ['Junuary', 'Feburary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',],
      }
      let salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: true
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: false,
            }
          }],
          yAxes: [{
            gridLines: {
              display: true,
            }
          }]
        }
      }
      new Chart(ctx, {
        type: 'bar',
        data: salesChartData,
        options: salesChartOptions
      })
    }

    const monthlyGreetRecapChart = () => {
      let ctx = document.getElementById('monthlyGreetChart')
      let salesChartData = {
        datasets: [{
          label: 'Launched',
          backgroundColor: 'rgba(2, 117, 216, 1)',
          borderColor: 'rgba(2, 117, 216, 1)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(2, 117, 216, 1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(2, 117, 216, 1)',
          fill: true,
          data: monthlyData[0].alllaunched
        }],
        labels: ['Junuary', 'Feburary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',],
      }
      let salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: true
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: false,
            }
          }],
          yAxes: [{
            gridLines: {
              display: true,
            }
          }]
        }
      }
      new Chart(ctx, {
        type: 'bar',
        data: salesChartData,
        options: salesChartOptions
      })
    }

    const editUser = async (id) => {
      await updateUser(id);
    }

    return {
      user,
      editUser,
      roles,
      can
    };
  }
}
</script>