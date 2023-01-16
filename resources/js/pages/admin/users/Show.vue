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

            <h3 class="profile-username text-center">{{ useradm['name'] }}</h3>

            <div v-for="role in useradm.roles" :key="role.id">
              <p v-if="role.name == 'super-admin'" class="text-muted text-center">User</p>
            </div>
            <div v-for="role in useradm.roles" :key="role.id">
              <p v-if="role.name != 'super-admin'" class="text-muted text-center">{{ role.name }}</p>
            </div>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>{{ useradm.email }}</b>
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
import { onBeforeMount, onMounted } from 'vue';
import useUser from "../../../services/userservices";
import Swal from 'sweetalert2';
import { useAbility } from '@casl/vue';

export default {
  props: ['id'],
  emits: ['role-updated'],
  setup(props, { emit }) {
    const { getUserAdmin, useradm, updateUser } = useUser();
    const { can } = useAbility();

    onBeforeMount(getUserAdmin(props.id));

    // onMounted(axios.get('/api/admin/getchartuseradmin/' + useradm.id).then((response) => {
    //   monthlyData.push(JSON.parse(JSON.stringify(response.data)))
    //   monthlyRecapChart();
    //   monthlyGreetRecapChart();
    // })
    //   .catch((error) => console.log(error)));

    const editUser = async (id) => {
      await updateUser(id);
    }

    return {
      useradm,
      editUser,
      can
    };
  }
}
</script>