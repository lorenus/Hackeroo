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