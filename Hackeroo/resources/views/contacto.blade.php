<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hackeroo</title>
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
                        <a href="{{route('login')}}">
                            <p>Entrar</p>
                        </a>
                    </div>
            </div>
            </ul>
        </div>
        </div>
    </nav>





    <div class="contenido container-fluid d-flex flex-column flex-md-row p-5">
        <!-- Imagen a la izq -->
        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center pe-4 order-0 order-md-0">
            <img src="/img/imagenes/contact.png" alt="Imagen" class="img-fluid">
        </div>
        <!-- Caja de texto a la der -->
        <div class="texto-info col-12 col-md-5 d-flex justify-content-center text-center order-1 order-md-1">
            <div>
                <h1>Contáctanos</h1>
                <form action="" class=" mt-4">
                    <div class="mb-3 text-start">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <x-text-input type="text" class="form-lineas" name="nombre" id="nombre" />
                    </div>
                    <div class="mb-3 text-start">
                        <label for="mail" class="form-label">Mail:</label>
                        <x-text-input type="email" class="form-lineas" name="mail" id="mail" />
                    </div>
                    <div class="mb-3 text-start">
                        <label for="mensaje" class="form-label">Mensaje:</label>
                        <x-text-area class="libreta" name="mensaje" id="mensaje" rows="4"></x-text-area>
                    </div>
                    <x-primary-button type="submit" class="boton">Enviar </x-primary-button>
                </form>
            </div>
        </div>
    </div>




    <!-- Footer -->
    <footer class="pt-4 px-5">
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