<template>
	<div class="app" :class="{ mobile: data.isActive }">
		<Sidebar></Sidebar>

		<div class="main-content">
			<Header @onMobile="changeToMobile"></Header>

			<div class="div-content">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Bienvenido al panel de administración</h5>
						<p>Usted puede administrar el contenido general de la web, desde textos, imagenes hasta colores.</p>
					</div>
				</div>
			</div>
			
		</div>
	</div>    
</template>

<script>
	import { ref, reactive } from 'vue';

    export default {
		setup() {
			const data = reactive({
				isActive: false
			})

			const changeToMobile = (isMobile) => {
				data.isActive = isMobile
			}

			return {
				changeToMobile,
				data,
			}
		}
	}

</script>