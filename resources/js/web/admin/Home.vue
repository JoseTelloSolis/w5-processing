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
                                
                                <form>
                                    <div class="mb-3">
                                        <label for="preview" class="form-label">Imagen principal - tamaño recomendado 1900 x 500 px</label>
                                        <input type="file" id="image" class="input-imagen" name="image" @change="onFileChange('image', $event)">
                                        <div class="div-imagen" :style="{ 'background-image': 'url(/assets_admin/img/mas.png)' }" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('image')" style="max-width: 700px;">
                                            <img class="img-responsive preview-image" :src="data.image" style="width: 90%;">
                                        </div>   
                                    </div>

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Titulo <span>(multilinea)</span></label>
                                        <textarea class="form-control" id="title" name="title" @input="resize('title')"></textarea>
                                    </div>

                                    <hr>

                                    <h6 class="card-subtitle mb-4 text-muted">Secci&oacute;n 1</h6>

                                    <div class="mb-3">
                                        <label for="title_section1" class="form-label">Titulo</label>
                                        <input type="text" class="form-control" id="title_section1" name="title_section1">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="text_section1" class="form-label">Texto</label>
                                        <textarea class="form-control" id="text_section1" name="text_section1" @input="resize('text_section1')"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="preview" class="form-label">Imagen - tamaño recomendado 1000 x 400 px</label>
                                        <input type="file" id="image_section1" class="input-imagen" name="image_section1" @change="onFileChange('image_section1', $event)">
                                        <div class="div-imagen" :style="{ 'background-image': 'url(/assets_admin/img/mas.png)' }" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('image_section1')" style="max-width: 700px;">
                                            <img class="img-responsive preview-image" :src="data.image_section1" style="width: 90%;">
                                        </div>   
                                    </div>

                                    <hr>

                                    <h6 class="card-subtitle mb-4 text-muted">Secci&oacute;n 2</h6>

                                    <div class="mb-3">
                                        <label for="title_section2" class="form-label">Titulo</label>
                                        <input type="text" class="form-control" id="title_section2" name="title_section2">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="text_section2" class="form-label">Texto</label>
                                        <textarea class="form-control" id="text_section2" name="text_section2" @input="resize('text_section2')"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="subtitle1_section2" class="form-label">Subtitulo 1</label>
                                        <input type="text" class="form-control" id="subtitle1_section2" name="subtitle1_section2">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="text1_section2" class="form-label">Texto 1</label>
                                        <textarea class="form-control" id="text1_section2" name="text1_section2" @input="resize('text1_section2')"></textarea>
                                    </div>                                    

                                    <div class="mb-3">
                                        <label for="preview" class="form-label">Imagen 1 - tamaño recomendado 500 x 350 px</label>
                                        <input type="file" id="image1_section2" class="input-imagen" name="image1_section2" @change="onFileChange('image1_section2', $event)">
                                        <div class="div-imagen" :style="{ 'background-image': 'url(/assets_admin/img/mas.png)' }" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('image1_section2')">
                                            <img class="img-responsive preview-image" :src="data.image1_section2" style="width: 60%;">
                                        </div>   
                                    </div>

                                    <div class="mb-3">
                                        <label for="subtitle2_section2" class="form-label">Subtitulo 2</label>
                                        <input type="text" class="form-control" id="subtitle2_section2" name="subtitle2_section2">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="text2_section2" class="form-label">Texto 2</label>
                                        <textarea class="form-control" id="text2_section2" name="text2_section2" @input="resize('text2_section2')"></textarea>
                                    </div>                                    

                                    <div class="mb-3">
                                        <label for="preview" class="form-label">Imagen 2 - tamaño recomendado 500 x 350 px</label>
                                        <input type="file" id="image2_section2" class="input-imagen" name="image2_section2" @change="onFileChange('image2_section2', $event)">
                                        <div class="div-imagen" :style="{ 'background-image': 'url(/assets_admin/img/mas.png)' }" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('image2_section2')">
                                            <img class="img-responsive preview-image" :src="data.image2_section2" style="width: 60%;">
                                        </div>   
                                    </div>

                                    <div class="mb-3">
                                        <label for="subtitle3_section2" class="form-label">Subtitulo 3</label>
                                        <input type="text" class="form-control" id="subtitle3_section2" name="subtitle3_section2">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="text3_section2" class="form-label">Texto 3</label>
                                        <textarea class="form-control" id="text3_section2" name="text3_section2" @input="resize('text3_section2')"></textarea>
                                    </div>                                    

                                    <div class="mb-3">
                                        <label for="preview" class="form-label">Imagen 3 - tamaño recomendado 500 x 350 px</label>
                                        <input type="file" id="image3_section2" class="input-imagen" name="image3_section2" @change="onFileChange('image3_section2', $event)">
                                        <div class="div-imagen" :style="{ 'background-image': 'url(/assets_admin/img/mas.png)' }" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('image3_section2')">
                                            <img class="img-responsive preview-image" :src="data.image3_section2" style="width: 60%;">
                                        </div>   
                                    </div>

                                    <hr>

                                    <h6 class="card-subtitle mb-4 text-muted">Secci&oacute;n 3</h6>

                                    <div class="mb-3">
                                        <label for="title_section3" class="form-label">Titulo</label>
                                        <input type="text" class="form-control" id="title_section3" name="title_section3">
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
    import { Tooltip } from 'bootstrap'

    export default {
		setup() {
            const file = ref(null)

			const data = reactive({
				isActive: false,
                image: '/portada.png',
                image_section1: '/about.png',
                image1_section2: '/consulting.png',
                image2_section2: '/montaje.png',
                image3_section2: '/support.png',
			})

			const changeToMobile = (isMobile) => {
				data.isActive = isMobile
			}

            const onFileChange = (myVar, e) => {
                let file = e.target.files[0];
                data[myVar] = URL.createObjectURL(file);
            }

            const triggerFile = (id) => {
                document.querySelector('#' + id).click();
            }

            const resize = (id) => {
                let element = document.querySelector('#' + id)

                element.style.height = "18px";
                element.style.height = element.scrollHeight + "px";
            }
            
            onMounted(() => {
                new Tooltip(document.body, {
                    selector: "[data-bs-toggle='tooltip']",
                })
            })

			return {
				changeToMobile,
                onFileChange,
                triggerFile,
                resize,
				data,
			}
		}
	}

</script>