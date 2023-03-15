<template>
	<div class="app" :class="{ mobile: data.isActive }">
		<Sidebar></Sidebar>

		<div class="main-content">
			<Header @onMobile="changeToMobile"></Header>

			<div class="div-content">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Perfil de usuario</h5>

                                <div id="toastSuccess" class="toast align-items-center position-fixed start-50 translate-middle-x text-bg-success" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
                                    <div class="toast-header">
                                        <strong class="me-auto">Mensaje</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div id="toast-message" class="toast-body">
                                        {{ data.toastMessage }}
                                    </div>
                                </div>

                                <div id="toastError" class="toast align-items-center position-fixed start-50 translate-middle-x text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
                                    <div class="toast-header">
                                        <strong class="me-auto">Mensaje</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div id="toast-message" class="toast-body">
                                        {{ data.toastMessage }}
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
                                
                                <form @submit.prevent="updateData" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Foto - tamaño recomendado 200 x 200 px</label>
                                        <input type="file" id="image" class="input-imagen" name="image" @change="onFileChange('image', $event)">
                                        <div class="div-imagen" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('image')">
                                            <img id="imagen_preview" class="img-responsive preview-image" :src="data.imagePreview">
                                        </div>   
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name" v-model="form.name">
                                    </div>

                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" v-model="form.lastname">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" v-model="form.email">
                                    </div>

                                    <div class="align-right">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Actualizar contraseña</h5>                                
                                
                                <form>
                                    
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña actual</label>
                                        <input type="password" class="form-control" id="password">
                                    </div>

                                    <div class="mb-3">
                                        <label for="new-password" class="form-label">Nueva contraseña</label>
                                        <input type="password" class="form-control" id="new-password">
                                    </div>

                                    <div class="mb-3">
                                        <label for="repeat-new-password" class="form-label">Repetir nueva contraseña</label>
                                        <input type="password" class="form-control" id="repeat-new-password">
                                    </div>

                                    <div class="align-right">
                                        <div class="tooltip-button" data-bs-toggle="tooltip" data-bs-placement="top" title="Deshabilitado en el demo">
                                            <button type="submit" class="btn btn-primary" disabled>Actualizar</button>
                                        </div>                                        
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
				
			</div>
			
		</div>
	</div>    
</template>

<script>
	import { ref, reactive } from 'vue';
    import { onMounted } from 'vue'
    import { Tooltip, Toast } from 'bootstrap'
    import { useRouter } from 'vue-router'

    export default {
		setup() {
            const router = useRouter()

            const form = ref({
                image: '',
                name: '',
                lastname: '',
                email: ''
            })

			const data = reactive({
				isActive: false,
                imagePreview: '',
                toastMessage: ''
			})

			const changeToMobile = (isMobile) => {
				data.isActive = isMobile
			}

            const onFileChange = (myVar, e) => {
                let file = e.target.files[0]

                form.value[myVar] = file
                data[myVar + 'Preview'] = URL.createObjectURL(file)
            }

            const triggerFile = (id) => {
                document.querySelector('#' + id).click();
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

                form.value = response.data.item
                data.imagePreview = form.value.image
            }

            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            const showToast = (id) => {
                let successToast = document.getElementById(id);
                let toast = new Toast(successToast);
                toast.show();
            }

            const updateData = () => {
                const formData = new FormData()
                formData.append('image', form.value.image)
                formData.append('name', form.value.name)
                formData.append('lastname', form.value.lastname)
                formData.append('email', form.value.email)

                axios.post('/api/updateprofile', formData, config)
                    .then((response) => {                          
                        if (response.status == '201') {
                            showToast('toastExpired')
                            setTimeout(() => {
                                router.push({ name: 'login' })
                            }, 5000)
                            return
                        }

                        data.toastMessage = response.data.message
                        showToast('toastSuccess')                        
                    })
                    .catch((error) => {
                        data.toastMessage = 'Ocurrió un error. Inténtelo mas tarde ...'
                        showToast('toastError')
                    })
            }
            
            onMounted(() => {
                new Tooltip(document.body, {
                    selector: "[data-bs-toggle='tooltip']",
                })

                getItem()
            })

			return {
				changeToMobile,
                onFileChange,
                triggerFile,
				data,
                form,
                showToast,
                updateData
			}
		}
	}

</script>