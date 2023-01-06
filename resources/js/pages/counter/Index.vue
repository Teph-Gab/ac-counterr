<template>
<div class="container-fluid">
        <!-- Info boxes -->
        <div class="row mt-2">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Completed</span>
                <span class="info-box-number" v-for="ac in acs" :key="ac.id">
                  {{ ac.completedacs.length }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-redo"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Restart</span>
                <span class="info-box-number" v-for="ac in acs" :key="ac.id">
                  {{ ac.restartacs.length }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-rocket"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Launched</span>
                <span class="info-box-number" v-for="ac in acs" :key="ac.id">
                  {{ ac.launchedacs.length }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <!-- <span class="info-box-icon bg-info elevation-1"><i class="fas fa-abacus"></i></span> -->

              <div class="info-box-content">
                <span class="info-box-text">Total</span>
                <span class="info-box-number" v-for="ac in acs" :key="ac.id">
                  {{ ac.restartacs.length + ac.completedacs.length + ac.launchedacs.length }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">

               <div style="display: flex; justify-content: space-between; aling-item: center">
                <h5 class="card-title"  v-show="showb == 0">
                  <add-acs @acs-added="refresh"></add-acs>
                </h5>
                  <h5 class="card-title" v-show="showb != 0">
                  <edit-acs v-for="ac in acs" :key="ac.id" v-bind:id="ac.id" @acs-added="refresh"></edit-acs>
                </h5>
                <h5 class="card-title">
                   <show-duplicated v-for="ac in acs" :key="ac.id" v-bind:duplicatedac="ac.duplicateacs"></show-duplicated>
                </h5>

                <div class="card-tools">
                  <div class="btn btn-tool mr-3" @click="copyAcs">
                    <i class="fas fa-copy"></i><span>Copy</span>
                  </div>
                  <div class="btn btn-tool" v-for="ac in acs" :key="ac.id" @click="clearAcs(ac.id)">
                    <i class="fas fa-trash bg-red"></i><span>Clear</span>
                  </div>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
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
                  </button>-->
                </div>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" v-for="ac in acs" :key="ac.id" style="text-align: justify; text-justify: inter-word;">
                      <span v-for="(completedac, index) in ac.completedacs" :key="index" style="color: #f5f5dc">
                        {{ completedac }}
                      </span>
                      <span v-for="(restartac, index) in ac.restartacs" :key="index" style="color: #FFC0CB">
                        {{ restartac }}
                      </span>
                      <span v-for="(launchedac, index) in ac.launchedacs" :key="index" style="color: #B0E0E6">
                        {{ launchedac }}
                      </span>
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
               <div class="row"></div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->    
</template>
  
<script>
import { onBeforeMount, onMounted } from 'vue';
import useCounter from "../../services/counterservices";
import Swal from 'sweetalert2';

  export default {
    props: ['user'],
    setup(props){
      const { getAcs, acs, copy, formatAcs, deleteAcs, showButton, showb } = useCounter();

      onBeforeMount(showButton);
      onMounted(getAcs);


      const refresh = async (ac) =>  {
        await axios.get('/api/counter')
          .then((response) => {
            showb.value = 1;
            acs.value = response.data;
          })
          .catch((error) => console.log(error));
    }

      const copyAcs = async () => {
          await copy(acs);
      }
 
      const clearAcs = async (id) => {
        await Swal.fire({
        title: 'Are you sure you want to clear?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
      }).then((result) => {
        if (result.isConfirmed) {
           deleteAcs(id);
          Swal.fire({
            toast: true,
            position: 'top-right',
            icon: 'info',
            title: 'Cleared!',
            showConfirmButton: false,
            color: '#fff',
            background: '#87adbd',
            timer: 1500,
            timerProgressBar: true
          }
          )
        }
      })
      }
 
      return {
        acs,
        formatAcs,
        copyAcs,
        refresh,
        clearAcs,
        showb
      };
    }
  }
</script>