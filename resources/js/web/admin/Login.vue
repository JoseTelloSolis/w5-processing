<template>
    <div class="content">
		
		<div class="h-center p-3">
			<img :src="'/assets_admin/img/logo_principal.png'">
		</div>
        
        <h2>Bienvenido</h2>

		<p>Ingrese con su cuenta para continuar</p>

        <div class="h-center">
            <div class="form-content">

                <form @submit.prevent="login">

                    <div class="input-group p-3">
                        <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                        <input type="text" class="form-control" name="username" placeholder="Usuario" v-model="form.username">
                    </div>

                    <div class="input-group p-3">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>

                        <input v-if="data.showPassword" type="text" class="form-control password-input" name="password" placeholder="Contraseña" v-model="form.password" />
                        <input v-else type="password" class="form-control password-input" name="password" placeholder="Contraseña" v-model="form.password">

                        
                        <span class="input-group-text transparent">
                            <a href="#" @click="toggleShow($event)"><i class="fa-regular" :class="{ 'fa-eye-slash': data.showPassword, 'fa-eye': !data.showPassword }"></i></a>                    
                        </span>
                    </div> 

                    <div class="h-center p-3" v-if="data.errorMessage">
                        <div class="alert alert-danger" role="alert">
                            {{ data.errorMessage }}
                        </div>
                    </div>  

                    <div class="h-center p-3">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>                    

                </form>

                <div class="row">
                    <div class="col-sm-5 py-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Recordarme</label>
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