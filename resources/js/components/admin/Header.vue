<template>
    <div class="header">
        <div class="hamburger">
            <a href="#" @click="mobile"><i class="fa-solid fa-bars"></i></a>
        </div>

        <div class="title">
            <h4>Dashboard</h4>
        </div>

        <div class="options">

            <a href="#" class="maximize" @click="toggle">
                <i class="fa-solid fa-maximize" v-if="fullscreen"></i>
                <i class="fa-solid fa-minimize" v-else></i>
            </a>

            <p>{{ data.name }}</p>

            <div class="dropdown" v-click-outside="closeDropdown">
                <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" @click="dropdown">
                    <img :src="data.image" class="profile-image">
                </a>

                <ul class="dropdown-menu" :class="{ 'custom-show': data.dropdown }">
                    <li><router-link class="dropdown-item" :to="{ name: 'profile' }"><i class="fa-solid fa-user"></i> Perfil</router-link></li>
                    <li><a class="dropdown-item" href="https://github.com/JoseTelloSolis/w5-processing" target="_blank"><i class="fa-brands fa-github"></i> Github</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" @click="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                </ul>
            </div>
        </div>

        <div id="toastExpired" class="toast align-items-center position-fixed start-50 translate-middle-x text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
            <div class="toast-header">
                <strong class="me-auto">Mensaje</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="toast-message" class="toast-body">
                Sesión expirada. Redireccionando ...
            </div>
        </div>

    </div>
</template>

<script>
    import { api as fullscreen } from 'vue-fullscreen'
    import { ref, reactive } from 'vue';
    import { Toast } from 'bootstrap'
    import { useRouter } from 'vue-router'
    import { onMounted } from 'vue'

    export default {
        methods: {
            async toggle () {
                await fullscreen.toggle(this.$el.querySelector('.fullscreen-wrapper'), {
                    teleport: this.teleport,
                    callback: (isFullscreen) => {
                        //this.fullscreen = isFullscreen
                    },
                })

                this.fullscreen = fullscreen.isFullscreen
            }
        },
        emits: ['onMobile'],
        setup(props, { emit }) {
            const router = useRouter()

            const data = reactive({
				dropdown: false,
                name: '',
                image: ''
			})

            let isMobile = false

            const mobile = () => {
                isMobile = !isMobile
                emit('onMobile', isMobile)
            }

            const dropdown = () => {
                data.dropdown = !data.dropdown
            }

            const closeDropdown = () => {
                if (data.dropdown == true) {
                    data.dropdown = false
                }
            }

            const logout = async() => {
                await axios.post('/api/logout')
                .then(response => {                        
                        try {
                            if (response.data.success === true) {
                                localStorage.removeItem('token')
                                router.push({ name: 'login' });
                            }
                            else {
                                console.log(response.data.message)
                            }
                        }
                        catch(error) {
                            console.log(response.data.message)
                        }
                    })
            }

            const showToast = (id) => {
                let successToast = document.getElementById(id);
                let toast = new Toast(successToast);
                toast.show();
            }

            const getItem = async() => {
                let response = await axios.get('/api/getprofile')

                if (response.status == '201') {
                    showToast('toastExpired')
                    setTimeout(() => {
                        router.push({ name: 'login' })
                    }, 5000)
                    return
                }

                data.name = response.data.item.name + ' ' + response.data.item.lastname
                data.image = response.data.item.image
            }

            onMounted(() => {
                getItem()
            })

            return {
                mobile,
                isMobile,
                fullscreen: true,
                teleport: true,
                dropdown,
                closeDropdown,                
                logout,
                showToast,
                data
            }
        }
    }
</script>