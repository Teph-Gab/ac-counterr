<template>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" @click="showCreateModal">
            <i class="fas fa-calculator"></i> Click to count
        </button>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity: 0.8">
            <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="staticBackdropLabel"> Add access code</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <textarea class="form-control" id="acs" rows="7" v-model="form.acs"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-block" @click="storeAcs">Count and
                            classify</button>
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </div>
</template>
      
<script>
import { reactive } from 'vue';
import useCounter from '../services/counterservices.js';
import Swal from 'sweetalert2';
export default {
    emits: ['acs-added'],

    setup(props, { emit }) {

        const form = reactive({
            acs: ''
        });

        let myModal = '';

        const { createAcs, acBrutCount, tot_acs, getAcs, acs } = useCounter();

        const showCreateModal = () => {
            myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
                backdrop: true
            });
            myModal.show()
        }

        const storeAcs = async () => {
            await acBrutCount({ ...form });
            await createAcs({ ...tot_acs.value })
            await Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'info',
                title: 'New access codes added',
                showConfirmButton: false,
                color: '#fff',
                background: '#87adbd',
                timer: 1500,
                timerProgressBar: true
            })
            await myModal.hide();
            await emit('acs-added', acs);
        }

        return {
            form,
            storeAcs,
            showCreateModal
        }
    }
}
</script>