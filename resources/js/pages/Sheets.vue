<template>
    <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-md-12 col-sm-6 mt-2">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item" v-for="sheet in sheets" :key="sheet.id"  @click="showSheet(sheet.url)">
                    <a class="nav-link" data-toggle="pill" href="#">{{ sheet.name }}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  data-toggle="pill" href="#"><add-sheet @sheet-added="refresh"></add-sheet></a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                  <div v-if="sheetUrl">
                    <iframe allowfullscreen :src="sheetUrl" style="width:100%; height:100vh; border: none;"></iframe>
                  </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
    </div>
</template>
      
<script>
import { onMounted } from 'vue';
import useSheet from "../services/sheetservices";

export default {

    setup() {
        const { sheets, getSheets, showSheet, sheetUrl } = useSheet();

        onMounted(getSheets);

        const refresh = (ac) =>  {
            getSheets();
         }

        return {
            sheets,
            getSheets,
            showSheet,
            sheetUrl,
            refresh
        };
    }
}
</script>