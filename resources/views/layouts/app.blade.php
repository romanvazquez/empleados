<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/tabler.min.css') }}">
    @stack('styles')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if ($isComponent)
        @livewireStyles
    @endif

</head>
<body class="{{ $isFluid ? 'layout-fluid' : '' }}">
    <script src="{{asset('js/demo-theme.min.js')}}"></script>
    <div class="page">
        <!-- Navbar -->
        <header class="navbar navbar-expand-md navbar-light d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Header logo -->
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    {{config('app.name')}}
                    {{-- <a href="#">
                        <img src="" width="110" height="32" alt="" class="navbar-brand-image">
                    </a> --}}
                </h1>

                <div class="navbar-nav flex-row order-md-last">
                    <div class="d-none d-md-flex me-3">
                        <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                            </svg>
                        </a>
                        <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="12" cy="12" r="4" />
                                <path
                                    d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                            </svg>
                        </a>
                    </div>
                    @auth

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                            aria-label="Abrir menú de usuario">
                            <span class="avatar avatar-rounded avatar-sm" style="background-image: url()">{{ auth()->user()->initials }}</span>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ auth()->user()->clave }}</div>
                                <div class="mt-1 small text-muted"></div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="#" class="dropdown-item">Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a href="" class="dropdown-item">Settings</a>

                            <a href="#" class="dropdown-item" onclick="document.getElementById('logout-form').submit()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                                    <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                                </svg>
                                Cerrar sesión
                            </a>
                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @endauth

                </div>
            </div>
        </header>
        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                    <div class="container-xl">

                        <x-menu-layout/>

                    </div>
                </div>
            </div>
        </div>
        <div class="page-wrapper">

            {{ $slot }}

            <x-footer-layout/>
        </div>
    </div>
    <script src="{{asset('js/tabler.min.js')}}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($isComponent)
        @livewireScripts
        <x-livewire-alert::scripts />

    @endif

    @stack('scripts')

</body>
</html>
