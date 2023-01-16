<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <!-- TABLE: Users-->
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title"> Users </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <!-- <th>ID</th> -->
                    <th>Name</th>
                    <th>email</th>
                    <th>role</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users" :key="user.id">
                    <!-- <td>{{ user.id }}</td> -->
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td v-if="user.roles[0].name == 'super-admin'">
                      <span class="badge badge-success text-capitalize">User</span>
                    </td>
                    <td v-else>
                      <span class="badge badge-success text-capitalize">{{ user.roles[0].name }}</span>
                    </td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
                        <router-link class-active="active" :to="{ name: 'admin.user.show', params: { id: user.id } }">
                          <i class="fas fa-eye mr-3"></i>
                        </router-link>
                        <router-link class-active="active" :to="{ name: 'admin.user.edit', params: { id: user.id } }">
                          <i class="fas fa-edit mr-3" style="color:blueviolet;"></i>
                        </router-link>
                        <i class="fas fa-trash" v-if="can('delete', 'user')" style="color:maroon;"></i>
                      </div>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
  <!--/. container-fluid -->
</template>
  
<script>
import { onMounted } from 'vue';
import useUser from "../../../services/userservices";
import { useAbility } from '@casl/vue';

export default {
  setup() {
    const { getUsers, users, roles } = useUser();
    const { can } = useAbility();

    onMounted(getUsers);

    return {
      users,
      can
    };
  }
}
</script>