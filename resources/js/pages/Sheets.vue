<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-6 m-0 p-0 mt-1">
                <div class="card card-primary card-outline card-outline-tabs" v-for="sheet in sheets" :key="sheet.id">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item" v-for="s in sheets">
                                <a class="nav-link" :id="s.id+'-tab'" data-toggle="pill"
                                    :href="'#'+s.id" role="tab" :aria-controls="s.id"
                                    aria-selected="true">{{ s.name }}</a>
                            </li>
        
                            <li class="nav-item">
                                <add-sheet class="nav-link" data-toggle="pill" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false"></add-sheet>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent" v-for="s in sheets">
                            <div class="tab-pane fade show active" :id="sheet.id" role="tabpanel"
                                :aria-labelledby="s.id+'tab'">
                                <iframe allowfullscreen :src="s.url" style="width:100%; height:100vh; border: none;"></iframe> 
                            </div>
                          
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- <template v-for="sh in sheets">
            <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">{{ sh.name }}</a></li>
                    </ul>
                    <div class="tab-content w-100" style="height: 100vh">
                        <div id="home" class="tab-pane fade in active">
                            <iframe allowfullscreen src="https://docs.google.com/spreadsheets/d/1QBnMgCHEZfu6UyACKy-Zo5Fn681GjeEVth-Sz6q5-zg/edit#gid=0pic_trulli.jpg" style="width:100%; height:100vh; border: none;"></iframe>
                        </div>
                    </div>
                    </template> -->

                  
            <!-- </div> -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</template>
      
<script>
import { onMounted } from 'vue';
import useSheet from "../services/sheetservices";

export default {

    setup() {
        const { sheets, getSheets } = useSheet();

        onMounted(getSheets);


        return {
            sheets,
            getSheets
        };
    }
}
</script>