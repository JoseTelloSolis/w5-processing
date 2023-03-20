<template>
    <div class="sidebar">
        
        <div class="h-center column text-center pt-4 pb-4 content-logo">
            <router-link :to="{ name: 'admin' }"><img :src="'/assets_admin/img/logo.png'" class="logo"></router-link>
        </div>

        <div class="h-center column text-center pt-4 pb-4 content-logo-mini">
            <router-link :to="{ name: 'admin' }"><img :src="'/assets_admin/img/logo_mini.png'" class="logo-mini"></router-link>
        </div>

        <div class="menu">
            <ul class="list-group">

                <router-link :to="{ name: 'config' }" class="web">
                    <li class="list-group-item">
                        <i class="fa-solid fa-gear"></i>
                        <span>Configuraciones</span>
                    </li>
                </router-link> 
                <router-link :to="{ name: 'config' }" class="mobile" data-bs-toggle="tooltip" data-bs-placement="right" title="Configuraciones">
                    <li class="list-group-item">
                        <i class="fa-solid fa-gear"></i>
                        <span>Configuraciones</span>
                    </li>
                </router-link> 

                <router-link :to="{ name: 'home' }" class="web">
                    <li class="list-group-item">
                        <i class="fa-solid fa-home"></i>
                        <span>Portada</span>
                    </li>
                </router-link> 
                <router-link :to="{ name: 'home' }" class="mobile" data-bs-toggle="tooltip" data-bs-placement="right" title="Portada">
                    <li class="list-group-item">
                        <i class="fa-solid fa-home"></i>
                        <span>Portada</span>
                    </li>
                </router-link>

                <a href="https://github.com/JoseTelloSolis/w5-processing" target="_blank" class="web">
                    <li class="list-group-item">
                        <i class="fa-brands fa-github"></i>
                        <span>Github</span>
                    </li>
                </a>
                <a href="https://github.com/JoseTelloSolis/w5-processing" target="_blank" class="mobile" data-bs-toggle="tooltip" data-bs-placement="right" title="Github">
                    <li class="list-group-item">
                        <i class="fa-brands fa-github"></i>
                        <span>Github</span>
                    </li>
                </a>

            </ul>
        </div>
       
    </div>
</template>

<script>
    import { onMounted } from 'vue'
    import { Tooltip } from 'bootstrap'

    export default {
        setup() {
            onMounted(() => {  
                const tooltips = document.querySelectorAll('.tooltip');

                tooltips.forEach(item => {
                    item.remove();
                });

                new Tooltip(document.body, {
                    selector: "[data-bs-toggle='tooltip']",
                })
            })
        }
    }
</script>