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
                                
                                <form>
                                    <div class="mb-3">
                                        <label for="preview" class="form-label">Foto - tamaño recomendado 200 x 200 px</label>
                                        <input type="file" id="imagen" ref="imagen" class="input-imagen" name="imagen" @change="onFileChange($event)">
                                        <div class="div-imagen" :style="{ 'background-image': 'url(/assets_admin/img/mas.png)' }" data-bs-toggle="tooltip" data-bs-placement="top" title="Clic en la imagen para reemplazarla" @click="triggerFile('imagen')">
                                            <img id="imagen_preview" class="img-responsive preview-image" :src="data.url">
                                        </div>   
                                    </div>     

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>

                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email">
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
    import { Tooltip } from 'bootstrap'

    export default {
		setup() {
            const file = ref(null)

			const data = reactive({
				isActive: false,
                url: '/assets_admin/img/admin.png'
			})

			const changeToMobile = (isMobile) => {
				data.isActive = isMobile
			}

            const onFileChange = (e) => {
                let file = e.target.files[0];
                data.url = URL.createObjectURL(file);
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