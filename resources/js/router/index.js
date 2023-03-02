import { createRouter, createWebHistory } from 'vue-router';

const IndexComponent = () => import ('../web/Index.vue');
const AdminIndexComponent = () => import ('../web/admin/Index.vue');
const LoginComponent = () => import ('../web/admin/Login.vue');
const ProfileComponent = () => import ('../web/admin/Profile.vue');
const HomeComponent = () => import ('../web/admin/Home.vue');
const ConfigComponent = () => import ('../web/admin/Config.vue');

const routes = [
    { path:'/', name:'index', component:IndexComponent },
    { path:'/admin/', name:'login', component:LoginComponent },
    { path:'/admin/inicio/', name:'admin', component:AdminIndexComponent },
    { path:'/admin/profile/', name:'profile', component:ProfileComponent },
    { path:'/admin/home/', name:'home', component:HomeComponent },
    { path:'/admin/config/', name:'config', component:ConfigComponent },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

export default router;