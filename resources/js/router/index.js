import { createRouter, createWebHistory } from "vue-router";

// Front end 
import Index from '../pages/counter/Index.vue';
import Dashboard from '../pages/Dashboard.vue';
import Sheets from '../pages/Sheets.vue';

const routes = [
    {
        path: '/home',
        name: 'index',
        component: Index
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/sheets',
        name: 'sheets',
        component: Sheets
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
});