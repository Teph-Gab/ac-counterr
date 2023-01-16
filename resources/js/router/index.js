import { createRouter, createWebHistory } from "vue-router";

import Swal from 'sweetalert2';

// Front end 
import Index from '../pages/counter/Index.vue';
import Dashboard from '../pages/Dashboard.vue';
import Sheets from '../pages/Sheets.vue';

// Front end admin part
import Users from '../pages/admin/users/Index.vue';
import UserShow from '../pages/admin/users/Show.vue';
import UserEdit from '../pages/admin/users/Edit.vue';

function removeQueryParams(to) {
    if (Object.keys(to.query).length)
      return { path: to.path, query: {}, hash: to.hash }
  }
  
  function removeHash(to) {
    if (to.hash) return { path: to.path, query: to.query, hash: '' }
  }

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
    },
    {
        path: '/admin/user',
        name: 'admin.user',
        component: Users,
        beforeEnter: (to, from, next) => {
            axios.get("/api/getuser").then((res) => {
                        const user = res.data;
                        if (user[0].roles[0].name == 'super-admin' || user[0].roles[0].name == 'admin')
                        {
                            next()
                        }
                        else {
                            Swal.fire({
                                toast: true,
                                position: 'top',
                                icon: 'info',
                                title: 'Avoid changing url manually, use buttons to navigate!',
                                showConfirmButton: false,
                                color: '#fff',
                                background: '#d9534f',
                                timer: 10500,
                                timerProgressBar: true
                            })
                            next('/home');
                        }
                    });
            },
        },
    {
        path: '/admin/user/:id',
        name: 'admin.user.show',
        component: UserShow,
        props: true,
        beforeEnter: (to, from, next) => {
            [removeQueryParams, removeHash];
            axios.get("/api/getuser").then((res) => {
                        const user = res.data;
                        if (user[0].roles[0].name == 'super-admin' || user[0].roles[0].name == 'admin')
                        {
                            next()
                        }
                        else {
                            Swal.fire({
                                toast: true,
                                position: 'top',
                                icon: 'info',
                                title: 'Avoid changing url manually, use buttons to navigate!',
                                showConfirmButton: false,
                                color: '#fff',
                                background: '#d9534f',
                                timer: 10500,
                                timerProgressBar: true
                            });
                            next('/home');
                        }
                    });
            },
    },
    {
        path: '/admin/user/:id',
        name: 'admin.user.edit',
        component: UserEdit,
        props: true,
        beforeEnter: (to, from, next) => {
            [removeQueryParams, removeHash];
            axios.get("/api/getuser").then((res) => {
                        const user = res.data;
                        if (user[0].roles[0].name == 'super-admin' || user[0].roles[0].name == 'admin')
                        {
                            next()
                        }
                        else {
                            Swal.fire({
                                toast: true,
                                position: 'top',
                                icon: 'info',
                                title: 'Avoid changing url manually, use buttons to navigate!',
                                showConfirmButton: false,
                                color: '#fff',
                                background: '#d9534f',
                                timer: 10500,
                                timerProgressBar: true
                            })
                            next('/home');
                        }
                    });
            },
    },
    {
        path: '/:pathMatch(.*)*',
        component: Index,
        beforeEnter: (to, from, next) => {
            Swal.fire({
                toast: true,
                position: 'top',
                icon: 'info',
                title: 'Avoid changing url manually, use buttons to navigate!',
                showConfirmButton: false,
                color: '#fff',
                background: '#d9534f',
                timer: 10500,
                timerProgressBar: true
            })
                next('/home')
            },
    },
]

export default createRouter({
    history: createWebHistory(),
    routes
});