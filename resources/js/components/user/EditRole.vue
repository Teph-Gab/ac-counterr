<template>
    <div>
        <!-- Modal -->
        <div class="modal fade" id="editmodal" data-bs-keyboard="false" tabindex="-1"
             aria-hidden="true" style="opacity: 0.8">
            <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="staticBackdropLabel"> User Role Update</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{  props.id }}
                        <!-- <div class="mb-3">
                            <textarea class="form-control" id="acs" rows="7" v-model="form.acs"></textarea>
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-block">Count and classify</button>
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </div>
</template>
      
<script>
import { reactive, onMounted } from 'vue';
import Swal from 'sweetalert2';
import useUser from '../../services/userservices.js';

export default {
    props: ['id'],
    // emits: ['acs-added'],
   // props, { emit }

    setup(props){
        const { roles } = useUser();

        // console.log(console.log(props.id))

        return{
          props
        }
    }
}
</script>