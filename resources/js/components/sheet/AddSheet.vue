<template>
    <div>
        <span class="text-warning" @click="showCreateModal">
            <i class="fas fa-plus"></i> Add new sheet
        </span>
        <!-- Modal -->
        <div class="modal fade" id="sheetmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity: 0.9">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="staticBackdropLabel"> New Sheet</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">close</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Teph Gab - Greet" v-model="form.name">
                        </div>
                        <div class="form-group">
                            <label for="url">Url</label>
                            <input type="text" class="form-control" id="url" placeholder="add sheet url" v-model="form.url">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" v-model="form.category">
                            <option>Greet</option>
                            <option>Proctor</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-block" @click="storeSheet">Add</button>
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
import useSheet from '../../services/sheetservices.js';
import Swal from 'sweetalert2';
export default {
    emits: ['sheet-added'],

    setup(props, { emit }){
    
        const form = reactive({
            name: '',
            url: '',
            category: ''
        });

        let myModal = '';

        const { createSheet, sheets } = useSheet();

        const showCreateModal = () => {
            myModal = new bootstrap.Modal(document.getElementById('sheetmodal'), {
                backdrop: true
            });
            myModal.show()
        }

        const storeSheet = async () => {
           await createSheet({ ... form })
           await Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'info',
                title: 'New sheet added',
                showConfirmButton: false,
                color: '#fff',
                background: '#87adbd',
                timer: 1500,
                timerProgressBar: true
            })
            await myModal.hide();
           await emit('sheet-added', sheets);
        }

        return{
            form,
            storeSheet,
            showCreateModal
        }
    }
}
</script>