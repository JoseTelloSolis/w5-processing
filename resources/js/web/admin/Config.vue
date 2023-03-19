<template>
	<div class="app" :class="{ mobile: data.isActive }">
		<Sidebar></Sidebar>

		<div class="main-content">
			<Header @onMobile="changeToMobile"></Header>

			<div class="div-content">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Configuraciones</h5>    
                                
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
                                        <label for="logo" class="form-label">Logo - tamaño recomendado 160 x 90 px</label>
                                        <input type="file" id="logo" class="input-imagen" name="logo" @change="onFileChange('logo', $event)">
                                        <div class="div-imagen" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('logo')">
                                            <img id="imagen_preview" class="img-responsive preview-image" :src="data.logoPreview">
                                        </div>   
                                    </div>

                                    <div class="mb-3">
                                        <label for="instagram" class="form-label">Instagram</label>
                                        <input type="text" class="form-control" id="instagram" name="instagram" v-model="form.instagram">
                                    </div>

                                    <div class="mb-3">
                                        <label for="facebook" class="form-label">Facebook</label>
                                        <input type="text" class="form-control" id="facebook" name="facebook" v-model="form.facebook">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="linkedin" class="form-label">Linkedin</label>
                                        <input type="text" class="form-control" id="linkedin" name="linkedin" v-model="form.linkedin">
                                    </div>

                                    <div class="align-right">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
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
                logo: '',
                instagram: '',
                facebook: '',
                linkedin: ''
            })

			const data = reactive({
				isActive: false,
                logoPreview: '',
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
                let response = await axios.get('/api/getconfig')

                if (response.status == '201') {
                    showToast('toastExpired')
                    setTimeout(() => {
                        router.push({ name: 'login' })
                    }, 5000)
                    return
                }

                form.value = response.data.item
                data.logoPreview = form.value.logo
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
                formData.append('logo', form.value.logo)
                formData.append('instagram', form.value.instagram)
                formData.append('facebook', form.value.facebook)
                formData.append('linkedin', form.value.linkedin)

                axios.post('/api/updateconfig', formData, config)
                    .then((response) => {                        
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
                updateData,
				data,
                form,
                showToast
			}
		}
	}

</script>