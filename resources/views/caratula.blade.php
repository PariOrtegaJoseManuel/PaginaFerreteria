@extends("layouts.app")

@section("content")
    <div class="hero-section" style="background-color: blue;">
        <div class="overlay"></div>
        <div class="hero-content container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Ferretería El Esmeril" class="main-logo animate__animated animate__fadeInLeft">
                </div>
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="display-3 fw-bold text-white animate__animated animate__fadeInRight">Ferretería "El Esmeril"</h1>
                    <p class="lead text-white mb-4 animate__animated animate__fadeInRight animate__delay-1s">Tu socio confiable en herramientas y materiales de construcción</p>
                    <div class="animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="{{ route('articulos.index') }}" class="btn btn-primary btn-lg me-3">
                            <i class="fas fa-shopping-cart me-2"></i>Ver Productos
                        </a>
                        <a href="#contacto" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-phone me-2"></i>Contáctanos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="stats-section py-5">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="stats-card animate__animated animate__fadeIn">
                        <i class="fas fa-tools fa-3x mb-3 text-primary"></i>
                        <h2 class="counter">1500+</h2>
                        <p class="text-muted">Productos</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card animate__animated animate__fadeIn animate__delay-1s">
                        <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                        <h2 class="counter">1000+</h2>
                        <p class="text-muted">Clientes Satisfechos</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card animate__animated animate__fadeIn animate__delay-2s">
                        <i class="fas fa-truck fa-3x mb-3 text-primary"></i>
                        <h2 class="counter">500+</h2>
                        <p class="text-muted">Entregas Mensuales</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card animate__animated animate__fadeIn animate__delay-3s">
                        <i class="fas fa-star fa-3x mb-3 text-primary"></i>
                        <h2 class="counter">10+</h2>
                        <p class="text-muted">Años de Experiencia</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="services-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 position-relative">
                Nuestros Servicios
            </h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card h-100">
                        <div class="icon-wrapper mb-4">
                            <i class="fas fa-tools fa-3x text-primary"></i>
                        </div>
                        <h3 class="h4 mb-3">Herramientas Profesionales</h3>
                        <p class="text-muted">Amplia gama de herramientas de las mejores marcas para todo tipo de proyectos</p>
                        <a href="#" class="btn btn-outline-primary mt-3">Ver más</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card h-100">
                        <div class="icon-wrapper mb-4">
                            <i class="fas fa-hard-hat fa-3x text-primary"></i>
                        </div>
                        <h3 class="h4 mb-3">Materiales de Construcción</h3>
                        <p class="text-muted">Los mejores materiales para construcción y remodelación de calidad garantizada</p>
                        <a href="#" class="btn btn-outline-primary mt-3">Ver más</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card h-100">
                        <div class="icon-wrapper mb-4">
                            <i class="fas fa-cogs fa-3x text-primary"></i>
                        </div>
                        <h3 class="h4 mb-3">Maquinaria Especializada</h3>
                        <p class="text-muted">Equipos y maquinaria de última generación para trabajos profesionales</p>
                        <a href="#" class="btn btn-outline-primary mt-3">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h2 class="text-center mb-5 position-relative">
            Novedades
        </h2>
    </div>
    <div class="carousel-section">
        <div class="container">
            <div id="mainCarousel" class="carousel slide carousel-fade col-md-6 mx-auto" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="square-img-container">
                            <img src="{{ asset('img/herramientas.jpg') }}" class="d-block w-100" alt="Herramientas">
                        </div>
                        <div class="carousel-caption">
                            <h2>Herramientas Profesionales</h2>
                            <p>Calidad y durabilidad garantizada</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="square-img-container">
                            <img src="{{ asset('img/materiales.jpg') }}" class="d-block w-100" alt="Materiales">
                        </div>
                        <div class="carousel-caption">
                            <h2>Materiales de Construcción</h2>
                            <p>Todo para tu proyecto constructivo</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="square-img-container">
                            <img src="{{ asset('img/electricidad.jpg') }}" class="d-block w-100" alt="Electricidad">
                        </div>
                        <div class="carousel-caption">
                            <h2>Material Eléctrico</h2>
                            <p>Soluciones eléctricas completas</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </div>

    <style>
        .square-img-container {
            position: relative;
            width: 100%;
            padding-bottom: 100%; /* Esto hace que el contenedor sea cuadrado */
            overflow: hidden;
        }

        .square-img-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Esto asegura que la imagen cubra todo el espacio sin deformarse */
        }
    </style>

    <footer class="footer-section" id="contacto">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Contacto</h4>
                    <p><i class="fas fa-phone me-2"></i> +591 12345678</p>
                    <p><i class="fas fa-envelope me-2"></i> info@elesmeril.com</p>
                </div>
                <div class="col-md-4">
                    <h4>Ubicación</h4>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Av. Principal #123, Santa Cruz</p>
                </div>
                <div class="col-md-4">
                    <h4>Horario</h4>
                    <p><i class="fas fa-clock me-2"></i> Lunes a Sábado: 8:00 - 18:00</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Ferretería "El Esmeril". Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

        .hero-section {
            height: 100vh;
            background: url('{{ asset('img/hero-bg.jpg') }}') center/cover no-repeat fixed;
        }

        .overlay {
            background: linear-gradient(45deg, rgba(0, 51, 102, 0.9), rgba(0, 51, 102, 0.7));
        }

        .stats-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            background: rgba(0, 123, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: none;
        }

        .feature-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .carousel-item img {
            height: 600px;
            filter: brightness(0.8);
        }

        .carousel-caption {
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(5px);
            border-radius: 20px;
            padding: 2rem;
        }

        @media (max-width: 768px) {
            .hero-section {
                height: auto;
                padding: 6rem 0;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.innerText);
                let count = 0;
                const speed = 2000 / target;

                const updateCount = () => {
                    if(count < target) {
                        count++;
                        counter.innerText = count + '+';
                        setTimeout(updateCount, speed);
                    }
                };

                updateCount();
            });
        });
    </script>
@endsection
