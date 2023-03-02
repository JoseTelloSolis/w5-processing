<template>
    <div class="content">
		
		<div class="h-center p-3">
			<img :src="'/assets_admin/img/logo_principal.png'">
		</div>
        
        <h2>Bienvenido</h2>

		<p>Ingrese con su cuenta para continuar</p>

        <div class="h-center">
            <div class="form-content">

                <form>

                    <div class="input-group p-3">
                        <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                        <input type="text" class="form-control" name="user" placeholder="Usuario" v-model="data.user">
                    </div>

                    <div class="input-group p-3">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>

                        <input v-if="data.showPassword" type="text" class="form-control password-input" name="password" placeholder="Contraseña" v-model="data.password" />
                        <input v-else type="password" class="form-control password-input" name="password" placeholder="Contraseña" v-model="data.password">

                        
                        <span class="input-group-text transparent">
                            <a href="#" @click="toggleShow($event)"><i class="fa-regular" :class="{ 'fa-eye-slash': data.showPassword, 'fa-eye': !data.showPassword }"></i></a>                    
                        </span>
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

    export default {
		setup() {
			const data = reactive({
				showPassword: false,
                password: 'demo',
				user: 'demo',
			})

			const toggleShow = (e) => {
                data.showPassword = !data.showPassword;
            }

			const buttonLabel = computed({
				get() {
					return (data.showPassword) ? "Hide" : "Show";
				},
			})

			return {
				toggleShow,
				buttonLabel,
				data,
			}
		}
    };
</script>