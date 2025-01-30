<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plantilla Básica</title>

  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <script src="{{ asset('js/animaciones.js') }}"></script>

</head>

<body>
  <nav class="navbar navbar-expand-sm pe-4">
    <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">
    <img src="/img/imagenes/logo.png" width="150" alt="Logo">  
    </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <img src="{{ asset('img/botones/abrir.svg') }}" alt="Hamburguesa" class="abrir">
        <img src="{{ asset('img/botones/cerrar.svg') }}" alt="Cerrar" class="cerrar" style="display: none;">
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto custom-menu">
          <li class="nav-item ms-4">
            <div class="enlace-con-subrayado">
              <a class="nav-link" href="{{ route('info') }}">Conócenos</a>
              <div class="subrayado1"></div>
            </div>
          </li>
          <li class="nav-item ms-4">
            <div class="enlace-con-subrayado">
              <a class="nav-link" href="{{ route('info') }}">Contáctanos</a>
              <div class="subrayado3"></div>
            </div>
          </li>
          <li class="nav-item ms-4">
            <div class="enlace-con-subrayado">
              <a class="nav-link" href="{{ route('faq') }}">Ayuda</a>
              <div class="subrayado2"></div>
            </div>
          </li>
          <div class="boton col-12 d-flex justify-content-center mt-5 ms-4 d-block d-sm-none">
            <a href="#">
              <p>Entrar</p>
            </a>
          </div>
      </div>
      </ul>
    </div>
    </div>
  </nav>


  


  <div class="contenido container-fluid d-flex flex-column flex-md-row p-5">

  <div class="texto-info col-12 col-md-6 d-flex justify-content-center text-center order-1 order-md-0">
  <div id="accordion">

<div class="card">
  <div class="card-header">
    <a class="btn" data-bs-toggle="collapse" href="#collapseOne">
      Cuenta
    </a>
  </div>
  <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
    <div class="card-body">
      Lorem ipsum..
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseTwo">
      Cursos
    </a>
  </div>
  <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
    <div class="card-body">
      Lorem ipsum..
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseThree">
      Ranking
    </a>
  </div>
  <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
    <div class="card-body">
      Lorem ipsum..
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseThree">
      Tareas
    </a>
  </div>
  <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
    <div class="card-body">
      Lorem ipsum..
    </div>
  </div>
</div>
</div> 
  </div>

  <!-- Imagen a la derecha -->
  <div class="col-12 col-md-6 d-flex justify-content-center align-items-center pe-4 order-0 order-md-1">
    <img src="/img/imagenes/faq.png" alt="Imagen" class="img-fluid">
  </div>
</div>





  <!-- Footer -->
  <footer class="pt-4 px-5 pb-3">
    <div class="row align-items-center">
      <!-- Primer div (izquierda) -->
      <div class="col-6 col-md-4 order-1 order-md-1 d-flex flex-column">
        <div class="enlace-bolita">
          <a href="#" class="d-block mb-2">Instagram</a>
          <div class="bolitaI"></div>
        </div>
        <div class="enlace-bolita">
          <a href="#" class="d-block mb-2">Twitter</a>
          <div class="bolitaI"></div>
        </div>
        <div class="enlace-bolita">
          <a href="#" class="d-block mb-2">Youtube</a>
          <div class="bolitaI"></div>
        </div>
      </div>

      <!-- Segundo div (centro) -->
      <div class="col-12 col-md-4 text-center order-3 order-md-2">
        <p>&copy; 2025 Mi Página. Todos los derechos reservados.</p>
      </div>

      <!-- Tercer div (derecha) -->
      <div class="col-6 col-md-4 text-end order-2 order-md-3 d-flex flex-column">
        <div class="enlace-bolita">
          <a href="#" class="d-block mb-2">Cookies</a>
          <div class="bolitaD"></div>
        </div>
        <div class="enlace-bolita">
          <a href="#" class="d-block mb-2">Política de privacidad</a>
          <div class="bolitaD"></div>
        </div>
        <div class="enlace-bolita">
          <a href="#" class="d-block mb-2">Términos y condiciones</a>
          <div class="bolitaD"></div>
        </div>
      </div>
    </div>
  </footer>


</body>

</html>