<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title"> {{ user.name }} </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="form-group" v-if="can('delete','user')">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" v-model="user.email">
              </div>
              <div class="form-group" v-for="role in user.roles" :key="role.id">
                  <span v-if="role.name == 'super-admin'" class="badge badge-success text-capitalize" style="font-size: 1.1rem;">User</span>
                  <span v-else class="badge badge-success text-capitalize" style="font-size: 1.1rem;">{{ role.name }}</span>
              </div>

              <div class="form-group" v-for="role in user.roles" :key="role.id">
                <!-- <div>Selected: {{ role.name }}</div> -->
                <select v-model="role.name">
                  <option disabled value="">Select role</option>
                  <option v-for="r in roles" :key="r.id">{{ r.name  }}</option>
                </select>
              </div>
   
              <button class="btn btn-primary" @click="editUser(user.id)"> Update user role </button>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a> -->
          </div>
          <!-- /.card-footer -->
        </div>

      </div>
    </div>
  </div>
  <!--/. container-fluid -->
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
    const { getUser, user, updateUser, getRoles, roles } = useUser();
    const { can } = useAbility();

    onMounted(getUser(props.id));
    onMounted(getRoles);

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