<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plantilla Básica</title>

  <!-- Enlace a los archivos de CSS de Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-sm">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto"> <!-- ms-auto para alinear a la derecha -->
          <li class="nav-item">
            <a class="nav-link" href="{{ route('info') }}">Conócenos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact') }}">Contáctanos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('faq') }}">Ayuda</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Container fluid (contenido de la página) -->
  <div class="contenido container-fluid d-flex flex-column align-items-center">
    <!-- Logo -->
    <div class="logo col-12 text-center mb-5">
      <h1 class="texto-animado">
        <span>&lt;</span>
        <span class="letra">H</span>
        <span class="letra">a</span>
        <span class="letra">c</span>
        <span class="letra">k</span>
        <span class="letra">e</span>
        <span class="letra">r</span>
        <span class="letra">o</span>
        <span class="letra">o</span>
        <span>/</span>
        <span>&gt;</span>
      </h1>
    </div>

    <!-- Botón -->
    <div class="boton col-12 d-flex justify-content-center">
        <a href="#">
            <p>Entrar</p>
        </a>
    </div>
</div>

  <!-- Footer -->
  <footer class="pt-4 px-5 pb-3">
    <div class="row align-items-center">
        <!-- Primer div (izquierda) -->
        <div class="col-6 col-md-4 order-1 order-md-1">
          <a href="#" class="d-block mb-2">Instagram</a>
          <a href="#" class="d-block mb-2">Twitter</a>
          <a href="#" class="d-block mb-2">Youtube</a>
        </div>

        <!-- Segundo div (centro) -->
        <div class="col-12 col-md-4 text-center order-3 order-md-2">
          <p>&copy; 2025 Mi Página. Todos los derechos reservados.</p>
        </div>

        <!-- Tercer div (derecha) -->
        <div class="col-6 col-md-4 text-end order-2 order-md-3">
          <a href="#" class="d-block mb-2">Cookies</a>
          <a href="#" class="d-block mb-2">Política de privacidad</a>
          <a href="#" class="d-block mb-2">Términos y condiciones</a>
        </div>
    </div>
</footer>

  <!-- Scripts de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

