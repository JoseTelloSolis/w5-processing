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
                                <h5 class="card-title">Portada</h5>

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
                                        <label for="image" class="form-label">Imagen principal - tamaño recomendado 1900 x 500 px</label>
                                        <input type="file" id="image" class="input-imagen" name="image" @change="onFileChange('image', $event)">
                                        <div class="div-imagen" :style="{ 'background-image': 'url(/assets_admin/img/mas.png)' }" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('image')" style="max-width: 700px;">
                                            <img id="imagen_preview" class="img-responsive preview-image" :src="data.imagePreview" style="width: 90%;">
                                        </div>   
                                    </div>

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Titulo <span>(multilinea)</span></label>
                                        <textarea class="form-control textarea" id="title" name="title" v-model="form.title" @input="resize('title')" @click="resize('title')"></textarea>
                                    </div>

                                    <hr>

                                    <h6 class="card-subtitle mb-4 text-muted">Secci&oacute;n 1</h6>

                                    <div class="mb-3">
                                        <label for="title_section1" class="form-label">Titulo</label>
                                        <input type="text" class="form-control" id="title_section1" name="title_section1" v-model="form.title_section1">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="text_section1" class="form-label">Texto</label>
                                        <ckeditor :editor="editor" v-model="form.text_section1" :config="editorConfig"></ckeditor>
                                    </div>

                                    <div class="mb-3">
                                        <label for="image_section1" class="form-label">Imagen - tamaño recomendado 1000 x 400 px</label>
                                        <input type="file" id="image_section1" class="input-imagen" name="image_section1" @change="onFileChange('image_section1', $event)">
                                        <div class="div-imagen" :style="{ 'background-image': 'url(/assets_admin/img/mas.png)' }" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('image_section1')" style="max-width: 700px;">
                                            <img id="image_section1_preview" class="img-responsive preview-image" :src="data.image_section1Preview" style="width: 90%;">
                                        </div>   
                                    </div>

                                    <hr>

                                    <h6 class="card-subtitle mb-4 text-muted">Secci&oacute;n 2</h6>

                                    <div class="mb-3">
                                        <label for="title_section2" class="form-label">Titulo</label>
                                        <input type="text" class="form-control" id="title_section2" name="title_section2" v-model="form.title_section2">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="text_section2" class="form-label">Texto</label>
                                        <ckeditor :editor="editor" v-model="form.text_section2" :config="editorConfig"></ckeditor>
                                    </div>

                                    <div class="mb-3">
                                        <label for="subtitle1_section2" class="form-label">Subtitulo 1</label>
                                        <input type="text" class="form-control" id="subtitle1_section2" name="subtitle1_section2" v-model="form.subtitle1_section2">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="text1_section2" class="form-label">Texto 1</label>
                                        <ckeditor :editor="editor" v-model="form.text1_section2" :config="editorConfig"></ckeditor>
                                    </div>            

                                    <div class="mb-3">
                                        <label for="image1_section2" class="form-label">Imagen - tamaño recomendado 500 x 350 px</label>
                                        <input type="file" id="image1_section2" class="input-imagen" name="image1_section2" @change="onFileChange('image1_section2', $event)">
                                        <div class="div-imagen" :style="{ 'background-image': 'url(/assets_admin/img/mas.png)' }" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('image1_section2')">
                                            <img id="image1_section2_preview" class="img-responsive preview-image" :src="data.image1_section2Preview" style="width: 60%;">
                                        </div>   
                                    </div>

                                    <div class="mb-3">
                                        <label for="subtitle2_section2" class="form-label">Subtitulo 2</label>
                                        <input type="text" class="form-control" id="subtitle2_section2" name="subtitle2_section2" v-model="form.subtitle2_section2">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="text2_section2" class="form-label">Texto 2</label>
                                        <ckeditor :editor="editor" v-model="form.text2_section2" :config="editorConfig"></ckeditor>
                                    </div>    

                                    <div class="mb-3">
                                        <label for="image2_section2" class="form-label">Imagen 2 - tamaño recomendado 500 x 350 px</label>
                                        <input type="file" id="image2_section2" class="input-imagen" name="image2_section2" @change="onFileChange('image2_section2', $event)">
                                        <div class="div-imagen" :style="{ 'background-image': 'url(/assets_admin/img/mas.png)' }" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('image2_section2')">
                                            <img id="image2_section2_preview" class="img-responsive preview-image" :src="data.image2_section2Preview" style="width: 60%;">
                                        </div>   
                                    </div>

                                    <div class="mb-3">
                                        <label for="subtitle3_section2" class="form-label">Subtitulo 3</label>
                                        <input type="text" class="form-control" id="subtitle3_section2" name="subtitle3_section2" v-model="form.subtitle3_section2">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="text3_section2" class="form-label">Texto 3</label>
                                        <ckeditor :editor="editor" v-model="form.text3_section2" :config="editorConfig"></ckeditor>
                                    </div>         

                                    <div class="mb-3">
                                        <label for="image3_section2" class="form-label">Imagen 3 - tamaño recomendado 500 x 350 px</label>
                                        <input type="file" id="image3_section2" class="input-imagen" name="image3_section2" @change="onFileChange('image3_section2', $event)">
                                        <div class="div-imagen" :style="{ 'background-image': 'url(/assets_admin/img/mas.png)' }" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('image3_section2')">
                                            <img id="image3_section2_preview" class="img-responsive preview-image" :src="data.image3_section2Preview" style="width: 60%;">
                                        </div>   
                                    </div>

                                    <hr>

                                    <h6 class="card-subtitle mb-4 text-muted">Secci&oacute;n 3</h6>

                                    <div class="mb-3">
                                        <label for="title_section3" class="form-label">Titulo</label>
                                        <input type="text" class="form-control" id="title_section3" name="title_section3" v-model="form.title_section3">
                                    </div>

                                    <div class="floating-submit">
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

    import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

    export default {
		setup() {
            const router = useRouter()

            const form = ref({
                image: '',
                title: '',
                title_section1: '',
                text_section1: '',
                image_section1: '',
                title_section2: '',
                text_section2: '',
                subtitle1_section2: '',
                text1_section2: '',
                image1_section2: '',
                subtitle2_section2: '',
                text2_section2: '',
                image2_section2: '',
                subtitle3_section2: '',
                text3_section2: '',
                image3_section2: '',
                title_section3: ''
            })

			const data = reactive({
				isActive: false,
                imagePreview: '',
                image_section1Preview: '',
                image1_section2Preview: '',
                image2_section2Preview: '',
                image3_section2Preview: '',
                toastMessage: ''
			})
            

            const editor = ClassicEditor
            const editorConfig = ref({
                toolbar: ['bold', 'italic', '|', 'bulletedList', '|', 'link', '|', 'undo', 'redo']
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
                let response = await axios.get('/api/gethome')

                if (response.status == '201') {
                    showToast('toastExpired')
                    setTimeout(() => {
                        router.push({ name: 'login' })
                    }, 5000)
                    return
                }

                form.value = response.data.item
                data.imagePreview = form.value.image
                data.image_section1Preview = form.value.image_section1
                data.image1_section2Preview = form.value.image1_section2
                data.image2_section2Preview = form.value.image2_section2
                data.image3_section2Preview = form.value.image3_section2
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
                console.log(form.value.text_section1)
                const formData = new FormData()
                formData.append('image', form.value.image)
                formData.append('title', form.value.title)
                formData.append('title_section1', form.value.title_section1)
                formData.append('text_section1', form.value.text_section1)
                formData.append('image_section1', form.value.image_section1)
                formData.append('title_section2', form.value.title_section2)
                formData.append('text_section2', form.value.text_section2)
                formData.append('subtitle1_section2', form.value.subtitle1_section2)
                formData.append('text1_section2', form.value.text1_section2)
                formData.append('image1_section2', form.value.image1_section2)
                formData.append('subtitle2_section2', form.value.subtitle2_section2)
                formData.append('text2_section2', form.value.text2_section2)
                formData.append('image2_section2', form.value.image2_section2)
                formData.append('subtitle3_section2', form.value.subtitle3_section2)
                formData.append('text3_section2', form.value.text3_section2)
                formData.append('image3_section2', form.value.image3_section2)
                formData.append('title_section3', form.value.title_section3)

                axios.post('/api/updatehome', formData, config)
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

            const resize = (id) => {
                let element = document.querySelector('#' + id)

                element.style.height = '18px'
                element.style.height = element.scrollHeight + 'px'
                console.log(element.scrollHeight)
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
                resize,
                editor,
                editorConfig,
                data,
                form,
                showToast,
                updateData
			}
		}
	}

</script>