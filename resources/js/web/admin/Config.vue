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
                                
                                <form>
                                    <div class="mb-3">
                                        <label for="preview" class="form-label">Logo - tamaño recomendado 160 x 90 px</label>
                                        <input type="file" id="image" class="input-imagen" name="image" @change="onFileChange('image', $event)">
                                        <div class="div-imagen" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('image')">
                                            <img id="imagen_preview" class="img-responsive preview-image" :src="data.image">
                                        </div>   
                                    </div>

                                    <div class="mb-3">
                                        <label for="instagram" class="form-label">Instagram</label>
                                        <input type="text" class="form-control" id="instagram" name="instagram">
                                    </div>

                                    <div class="mb-3">
                                        <label for="facebook" class="form-label">Facebook</label>
                                        <input type="text" class="form-control" id="facebook" name="facebook">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="linkedin" class="form-label">Linkedin</label>
                                        <input type="text" class="form-control" id="linkedin" name="linkedin">
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
                image: '/logo.png'
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
            
            onMounted(() => {
                new Tooltip(document.body, {
                    selector: "[data-bs-toggle='tooltip']",
                })
            })

			return {
				changeToMobile,
                onFileChange,
                triggerFile,
				data,
			}
		}
	}

</script>