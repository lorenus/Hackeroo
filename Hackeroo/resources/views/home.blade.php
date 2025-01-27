<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <!-- Agregar Bootstrap vía CDN o instalación (si lo deseas) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Navegación -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Mi Proyecto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/courses">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Iniciar sesión</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Contenido principal de la página de inicio -->
        <div class="text-center mt-5">
            <h1>Bienvenido a nuestra plataforma</h1>
            <p>Conoce nuestros cursos y empieza a aprender hoy mismo.</p>
            <a href="/courses" class="btn btn-primary">Ver Cursos</a>
        </div>

        <!-- Sección de características o información adicional -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Curso 1">
                    <div class="card-body">
                        <h5 class="card-title">Curso 1</h5>
                        <p class="card-text">Aprende las bases de Angular en este curso introductorio.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Curso 2">
                    <div class="card-body">
                        <h5 class="card-title">Curso 2</h5>
                        <p class="card-text">Domina Laravel y desarrolla aplicaciones web.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Curso 3">
                    <div class="card-body">
                        <h5 class="card-title">Curso 3</h5>
                        <p class="card-text">Descubre las mejores prácticas en programación de backend.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
