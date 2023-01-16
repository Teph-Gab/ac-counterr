require('./bootstrap');

import axios from "axios";
import { createApp } from "vue";
import router from './router';
import { Bar } from 'vue-chartjs'
import { abilitiesPlugin } from '@casl/vue';
import defineAbilityFor from './services/ability';

import Index from './pages/counter/Index.vue';
import AddAcs from './components/AddAcs.vue';
import EditAcs from './components/EditAcs.vue';
import ShowDuplicated from './components/ShowDuplicated.vue';
import AddSheet from './components/sheet/AddSheet.vue';
import EditRole from './components/user/EditRole.vue';

const getUser = async () => {
  await axios.get('/api/getuser').then(response => {
    const user = response.data;
    const ability = defineAbilityFor(user)

    const app = createApp({Index});
    app.component('AddAcs', AddAcs);
    app.component('EditAcs', EditAcs);
    app.component('AddSheet', AddSheet);
    app.component('EditRole', EditRole);
    app.component('ShowDuplicated', ShowDuplicated);
    app.component('Bar', Bar);
    app.use(abilitiesPlugin, ability)
    app.use(router).mount("#app");
  })
}
getUser();