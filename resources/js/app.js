require('./bootstrap');

import { createApp } from "vue";
import router from './router';
import { Bar } from 'vue-chartjs'
// import { abilitiesPlugin } from '@casl/vue';
// import ability from '@casl/ability';
// import { abilitiesPlugin, ability } from '@casl/vue';
// import ability from './services/ability';

import Index from './pages/counter/Index.vue';
import AddAcs from './components/AddAcs.vue';
import EditAcs from './components/EditAcs.vue';
import AddSheet from './components/sheet/AddSheet.vue';


const app = createApp({Index});
app.component('AddAcs', AddAcs);
app.component('EditAcs', EditAcs);
app.component('AddSheet', AddSheet);
app.component('Bar', Bar);
// app.use(abilitiesPlugin, ability, {
//     useGlobalProperties: true
//   })
app.use(router).mount("#app");