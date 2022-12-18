require('./bootstrap');

import { createApp } from "vue";
import router from './router';

import Index from './pages/counter/Index.vue';
import AddAcs from './components/AddAcs.vue';
import EditAcs from './components/EditAcs.vue';
import AddSheet from './components/sheet/AddSheet.vue';


const app = createApp({Index});
app.component('AddAcs', AddAcs);
app.component('EditAcs', EditAcs);
app.component('AddSheet', AddSheet);
// app.use(Swal);
app.use(router).mount("#app");