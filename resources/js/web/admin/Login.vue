<template>
    <div class="content content-login">
		
        <div class="container-fluid">
            <div class="container form-content">
                <div class="row">

                    <div class="d-none d-sm-none d-md-block col-md-6">
                        <div class="v-center">                            
                            <img :src="`./assets_admin/img/logo.png`" class="logo">
                        </div>
                    </div>

                    <div class="d-sm-block d-md-none col-md-6">
                        <div class="v-center">
                            <img :src="`./assets_admin/img/logo_mobile.png`" class="logo">
                        </div>
                    </div>
                    
                    <div class="col-md-6">

                        <div class="login-v-center">

                            <h2>Log in</h2>
                        
                            <form @submit.prevent="login">

                                <div class="input-group">
                                    <label for="username" class="form-label">Usuario</label>
                                </div>

                                <div class="input-group py-3">                                  
                                    <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                                    <input type="text" class="form-control" id="username" name="username" v-model="form.username">
                                </div>

                                <div class="input-group">
                                    <label for="password" class="form-label">Contrase&ntilde;a</label>
                                </div>

                                <div class="input-group py-3">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>

                                    <input v-if="data.showPassword" type="text" class="form-control password-input" id="password" name="password" placeholder="Contraseña" v-model="form.password" />
                                    <input v-else type="password" class="form-control password-input" id="password" name="password" v-model="form.password">

                                    
                                    <span class="input-group-text transparent">
                                        <a href="#" @click="toggleShow($event)"><i class="fa-regular" :class="{ 'fa-eye-slash': data.showPassword, 'fa-eye': !data.showPassword }"></i></a>                    
                                    </span>
                                </div> 

                                <div class="h-center py-3" v-if="data.errorMessage">
                                    <div class="alert alert-danger" role="alert">
                                        {{ data.errorMessage }}
                                    </div>
                                </div>  

                                <div class="h-center py-3">
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
                                </div>                    

                            </form>

                        </div>                        

                    </div>

                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
	import { ref, reactive, computed } from 'vue';
    import { useRouter } from 'vue-router'

    export default {
		setup() {
            const router = useRouter()

			const data = reactive({
				showPassword: false,
                errorMessage: null           
			})

            const form = reactive({
                password: 'demo',
				username: 'demo',
            })

			const toggleShow = (e) => {
                data.showPassword = !data.showPassword;
            }

			const buttonLabel = computed({
				get() {
					return (data.showPassword) ? "Hide" : "Show";
				},
			})
            
            const login = async() => {
                await axios.post('/api/login', form)
                    .then(response => {
                        try {
                            if (response.data.success === true) {
                                data.errorMessage = null

                                localStorage.setItem('token', response.data.token)
                                router.push({ name: 'admin' })
                            }
                            else {
                                localStorage.removeItem('token')
                                data.errorMessage = response.data.message
                            }
                        }
                        catch(error) {
                            localStorage.removeItem('token')
                            data.errorMessage = 'Ocurrió un error. Intentelo mas tarde...'
                        }
                    })
            }

			return {
				toggleShow,
				buttonLabel,
                login,
                form,
				data,
			}
		}
    };
</script>