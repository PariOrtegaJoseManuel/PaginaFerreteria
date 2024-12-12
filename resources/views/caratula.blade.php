@extends("layouts.app")

@section("content")

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferretería El Esmeril</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header-title {
            background-color: #003366;
            color: white;
            padding: 40px 20px;
            margin-bottom: 10px; /* Espaciado reducido para dar más margen al logo */
            text-align: center;
            border-bottom: 5px solid #f8c471;
        }

        .header-title h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .logo-container {
            text-align: center;
            margin: -20px 0 10px 0; /* Elevamos la posición del logo */
        }

        .logo-container img {
            width: 200px; /* Tamaño del logo aumentado */
            height: auto;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .carousel-item img {
            height: 450px; /* Altura ajustada para más espacio */
            object-fit: cover;
            border-radius: 10px;
        }

        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            font-size: 1rem;
        }

        footer {
            background-color: #003366;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 30px;
        }

        footer a {
            color: #f8c471;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Encabezado -->
    <div class="header-title">
        <h1>Ferretería "El Esmeril"</h1>
        <p>Tu mejor opción en herramientas y materiales de construcción</p>
    </div>

    <!-- Logo -->
    <div class="logo-container">
        <img src="{{ asset('img/logo.png') }}" alt="Logo Ferretería El Esmeril">
    </div>

    <!-- Carrusel -->
    <div class="container">
        <div id="carouselArticulos" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselArticulos" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselArticulos" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselArticulos" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/herramientas.jpg') }}" class="d-block w-100" alt="Herramientas">
                    <div class="carousel-caption">
                        <h5>Herramientas de Calidad</h5>
                        <p>Encuentra las mejores marcas en herramientas para tus proyectos</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/materiales.jpg') }}" class="d-block w-100" alt="Materiales">
                    <div class="carousel-caption">
                        <h5>Materiales de Construcción</h5>
                        <p>Todo lo que necesitas para tu obra</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/electricidad.jpg') }}" class="d-block w-100" alt="Electricidad">
                    <div class="carousel-caption">
                        <h5>Material Eléctrico</h5>
                        <p>Amplio surtido en material eléctrico y de iluminación</p>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselArticulos" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselArticulos" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} Ferretería "El Esmeril". Todos los derechos reservados.</p>
    </footer>
</body>
</html>

@endsection
