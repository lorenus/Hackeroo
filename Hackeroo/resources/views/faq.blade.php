<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackeroo</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
                            <a class="nav-link" href="{{ route('contacto') }}">Contáctanos</a>
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
                        <a href="{{ route('login') }}">
                            <p>Entrar</p>
                        </a>
                    </div>
            </div>
            </ul>
        </div>
        </div>
    </nav>





    <div class="contenido container-fluid d-flex flex-column flex-md-row p-5">
        <!-- Caja de texto a la izquierda -->
        <div class="texto-info col-12 col-md-6 d-flex justify-content-center text-center order-1 order-md-0">

            <div id="accordion">

                <div class="card">
                    <div class="card-header">
                        <a class="btn hand-cursor" data-bs-toggle="collapse" href="#collapseCuenta">
                            <h3 class="hand-cursor">Cuenta</h3>
                        </a>
                    </div>
                    <div id="collapseCuenta" class="collapse show" data-bs-parent="#accordion">
                        <div class="card-body text-start">
                            <p><b>Pregunta 1</b></p>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, eveniet. Illum non fugit libero voluptates iusto magni fuga distinctio commodi nostrum sit.</p>
                            <br>
                            <p><b>Pregunta 2</b></p>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex officia quae itaque ipsam dolorum adipisci, placeat beatae impedit laborum eos ullam cumque dolores.</p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <a class="collapsed btn hand-cursor " data-bs-toggle="collapse" href="#collapseCursos">
                            <h3 class="hand-cursor">Cursos</h3>
                           </a>
                    </div>
                    <div id="collapseCursos" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body text-start">
                        <p><b>Pregunta 1</b></p>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam alias labore, doloremque cum ipsam neque eos enim maiores consectetur explicabo deserunt hic odit sit excepturi dolorum autem soluta! Id, nostrum.</p>
                            <br>
                            <p><b>Pregunta 2</b></p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus alias explicabo totam, illo praesentium quia vitae officiis? Maiores, facere eos? Provident at, quis odio ducimus aliquam culpa exercitationem soluta tempora?</p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <a class="collapsed btn hand-cursor " data-bs-toggle="collapse" href="#collapseRanking">
                            <h3 class="hand-cursor">Ranking</h3>
                        </a>
                    </div>
                    <div id="collapseRanking" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body text-start">
                        <p><b>Pregunta 1</b></p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat laboriosam fugit nulla doloremque.eveniet quos ut exercitationem voluptates eaque dicta.</p>
                            
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <a class="collapsed btn hand-cursor " data-bs-toggle="collapse" href="#collapseTareas">
                            <h3 class="hand-cursor">Tareas</h3>
                        </a>
                    </div>
                    <div id="collapseTareas" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body text-start">
                        <p><b>Pregunta 1</b></p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt aspernatur necessitatibus, repudiandae dolore rem quisquam nostrum reiciendis beatae non voluptatem expedita aperiam molestiae autem eos suscipit maxime? Quaerat, doloribus velit?</p>

                        </div>
                    </div>
                </div>


            </div>





        </div>

        <!-- Imagen a la derecha -->
        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center pe-4 order-0 order-md-0">
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