<template>
    <div>
        <button type="button" class="btn" data-bs-toggle="modal" @click="showDuplicatedModal" v-for="ac in acs" :key="ac.id"  v-show="ac.duplicateacs.length" style="background: #3b444b">
            <span class="text-danger"> <i class="fas fa-exclamation-circle"></i> Duplicated <span class="badge badge-danger"> {{ ac.duplicateacs.length }}</span></span>
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="duplicatedModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="opacity: 0.8">
            <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="staticBackdropLabel"> Duplicated access codes</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12" v-for="ac in acs" :key="ac.id" style="text-align: justify; text-justify: inter-word;">
                            <div v-for="(duplicatedac, index) in ac.duplicateacs" :key="index">
                                {{ duplicatedac }}
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </div>
</template>
      
<script>
import { onMounted } from 'vue';
import useCounter from '../services/counterservices.js';
export default {

    setup() {
        let myModal = '';

        const { getAcs, acs } = useCounter();

        const showDuplicatedModal = () => {
            myModal = new bootstrap.Modal(document.getElementById('duplicatedModal'), {
                backdrop: true
            });
            myModal.show()
        }

        onMounted(getAcs);
    
        return {
            showDuplicatedModal,
            acs
        }
    }
}
</script>