<template>
    <div id="home" class="container div-menu">
        <div class="row">
            <div class="col-sm-12">
                <nav class="navbar navbar-expand-lg">
                    <a href="#home" class="navbar-brand"><img :src="config.logo" class="logo"></a>
                    <button id="buttom-menu" class="navbar-toggler" type="button" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" @click.prevent="openMenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#services">Services</a>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" href="#contact">Contact</a>
                            </li>
                        </ul>    
                        <ul class="navbar-nav sm-icons">
                            <li class="nav-item"><a class="nav-link circle-link" :href="config.instagram" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li class="nav-item"><a class="nav-link circle-link" :href="config.facebook" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="nav-item"><a class="nav-link circle-link" :href="config.linkedin" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                        </ul>                         
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div id="landing" class="container-fluid landing">
        <img :src="data.image" alt="" class="full">

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 v-html="nl2br(data.title)"></h1>
                </div>
            </div>
        </div>
        
    </div>

    <div id="menu-mobile" class="sidebar-mobile">

        <a href="#" id="close-menu" class="closebtn"  @click.prevent="closeMenu">&times;</a>

        <div class="sidebar-mobile-content px-4">                

            <a href="#home">
                <img :src="config.logo" alt="" class="logo-sidebar-mobile">
            </a>

            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
        
    </div>  

    <div class="container div-content">
        <div class="row">
            <div class="col-lg-2 div-sidebar d-none d-sm-none d-md-none d-lg-block">

                <div class="sidebar">
                    <a href="#home">
                        <img :src="config.logo" alt="" class="logo-sidebar">
                    </a>

                    <ul>
                        <li><a href="#about">About</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>                    

            </div>

            <div class="col-md-12 col-lg-10 content">

                <div id="about" class="div-section1">
                    <h2 class="title2">{{ data.title_section1 }}</h2>

                    <p v-html="data.text_section1"></p>

                    <div class="image">
                        <img :src="data.image_section1" alt="" class="full">
                    </div>
                </div>

                <div id="services" class="div-section2">
                    <h2 class="title">{{ data.title_section2 }}</h2>

                    <p v-html="data.text_section2"></p>

                    <h3 class="subtitle1">{{ data.subtitle1_section2 }}</h3>

                    <div class="row">
                        <div class="col-md-7">
                            <p v-html="data.text1_section2"></p>
                        </div>

                        <div class="col-md-5">
                            <div class="img-hover-zoom img-hover-zoom--xyz">
                                <img :src="data.image1_section2" alt="full">
                            </div>                                
                        </div>
                    </div>

                    <h3 class="subtitle2">{{ data.subtitle2_section2 }}</h3>

                    <div class="row">
                        <div class="col-md-7">
                            <p v-html="data.text2_section2"></p>
                        </div>

                        <div class="col-md-5">
                            <div class="img-hover-zoom img-hover-zoom--xyz">
                                <img :src="data.image2_section2" alt="full">
                            </div>
                        </div>
                    </div>

                    <h3 class="subtitle3">{{ data.subtitle3_section2 }}</h3>

                    <div class="row">
                        <div class="col-md-7">
                            <p v-html="data.text3_section2"></p>
                        </div>

                        <div class="col-md-5">
                            <div class="img-hover-zoom img-hover-zoom--xyz">
                                <img :src="data.image3_section2" alt="full">
                            </div>
                        </div>
                    </div>

                </div>

                <div id="contact" class="div-section3">
                    <h2 class="title3">{{ data.title_section3 }}</h2>
                    
                    <div class="horizontal-items">
                        <a class="circle-link" :href="config.instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a class="circle-link" :href="config.facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a class="circle-link" :href="config.linkedin" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import { onMounted } from 'vue'
    import { ref, reactive } from 'vue';

    export default {
        setup() {
            let scrollDown = false

            const config = ref({
                logo: '',
                instagram: '',
                facebook: '',
                linkedin: ''
            })

            const data = ref({
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

            const getConfig = async() => {
                let response = await axios.get('/api/getwebconfig')

                config.value = response.data.item
            }

            const getData = async() => {
                let response = await axios.get('/api/getwebhome')

                data.value = response.data.item
            }

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    // If the element is visible
                    if (entry.isIntersecting) {
                        // Add the animation class
                        entry.target.classList.add('show');
                        return;
                    }

                    //entry.target.classList.remove('show');
                });
            });

            const observerNotHidden = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    // If the element is visible
                    if (entry.isIntersecting) {
                        // Add the animation class
                        entry.target.classList.add('show');
                        return;
                    }
                });
            });

            const observerisHidden = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    // If the element is visible
                    if (entry.isIntersecting) {
                        // Add the animation class
                        document.querySelector('.sidebar').classList.remove('show');
                        return;
                    }

                    document.querySelector('.sidebar').classList.add('show');
                });
            });

            const openMenu = () => {
                document.getElementById('menu-mobile').style.width = '250px'
            }

            const closeMenu = () => {
                document.getElementById('menu-mobile').style.width = '0'
            }

            const nl2br = (text) => {
                return text.replace(/\n/g, '<br>')
            }

            onMounted(() => {
                getConfig()
                getData()

                observerisHidden.observe(document.querySelector('.landing'));

                observer.observe(document.querySelector('.title'));
                observer.observe(document.querySelector('.title2'));
                observer.observe(document.querySelector('.title3'));

                observer.observe(document.querySelector('.subtitle1'));
                observer.observe(document.querySelector('.subtitle2'));
                observer.observe(document.querySelector('.subtitle3'));

                observerNotHidden.observe(document.querySelector('.image'));
            })

            return {
                openMenu,
                closeMenu,
                nl2br,
                data,
                config
            }

        }
    }
</script>
