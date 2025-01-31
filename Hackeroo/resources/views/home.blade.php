<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Cerrar sesión
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
  <nav class="navbar navbar-expand-sm justify-content-end">
    <ul class="navbar-nav">
      <li class="nav-item me-3">
        <a class="nav-link" href="#">Conócenos</a>
      </li>
      <li class="nav-item me-3">
        <a class="nav-link" href="#">Contáctanos</a>
      </li>
      <li class="nav-item me-4">
        <a class="nav-link" href="#">Ayuda</a>
      </li>
    </ul>
  </nav>

  <div class="contenedor container-fluid">
    <div class="row">
      <div class="logo col-12 d-flex justify-content-center align-items-center">
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
    </div>


    <div class="row">
      <div class="boton col-12 d-flex justify-content-center">
        <a href="#">
          <p>Entrar</p>
        </a>
      </div>
    </div>
  </div>

  <footer class="container-fluid p-5 fixed-bottom">
    <div class="row align-items-center">
      <div class="col-md-4">
        <a href="#" class="d-block mb-2">Instagram</a>
        <a href="#" class="d-block mb-2">Twitter</a>
        <a href="#" class="d-block mb-2">Youtube</a>
      </div>
      <div class="col-md-4 text-center">
        <p>© 2025 Hackeroo</p>
      </div>
      <div class="col-md-4 text-end">
        <a href="#" class="d-block mb-2">Cookies</a>
        <a href="#" class="d-block mb-2">Política de privacidad</a>
        <a href="#" class="d-block mb-2">Términos y condiciones</a>
      </div>
  </footer>
</body>

</html>