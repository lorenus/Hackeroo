<nav class="navbar navbar-expand-sm">
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
                <!-- <li class="nav-item ms-4">
                    <div class="enlace-con-subrayado">
                        <a class="nav-link" href="{{ route('perfil') }}">Mi Perfil</a>
                        <div class="subrayado1"></div>
                    </div>
                </li> -->
                <li class="nav-item ms-4">
                    <div class="enlace-con-subrayado">
                        <a class="nav-link" href="{{ route('cursos-alumno') }}">Mis Cursos</a>
                        <div class="subrayado3"></div>
                    </div>
                </li>
                <li class="nav-item ms-4">
                    <div class="enlace-con-subrayado">
                        <a class="nav-link" href="{{ route('ranking') }}">Ranking</a>
                        <div class="subrayado2"></div>
                    </div>
                </li>
                <li class="nav-item ms-4">
                    <div class="enlace-con-subrayado">
                        <a class="nav-link" href="{{ route('editar-perfil') }}">Editar Perfil</a>
                        <div class="subrayado3"></div>
                    </div>
                </li>
                @if(Auth::check())
                <li class="nav-item">
                    <div class="enlace-con-subrayado">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-primary-button class='btn ms-4 border-0 mt-5 d-block d-sm-none'>
                    {{ __('Cerrar sesión') }}
                    </x-primary-button>
                        </form>
                    </div>
                </li>
                @else
                @endif
        </div>
        </ul>
    </div>
    </div>
</nav>