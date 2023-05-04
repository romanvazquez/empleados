<ul class="navbar-nav {{ $is_vertical ? 'pt-lg-3' : '' }}">
    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>
            </span>
            <span class="nav-link-title">
                Inicio
            </span>
        </a>
    </li>
    <li class="nav-item dropdown {{ request()->routeIs('usuarios') || request()->routeIs('empleados') ? 'active' : '' }}">
        <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="off" role="button">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                </svg>
            </span>
            <span class="nav-link-title">
                Empleados
            </span>
        </a>
        <div class="dropdown-menu {{
            $is_vertical &&
            (
                request()->routeIs('usuarios') ||
                request()->routeIs('empleados')
            ) ? 'show' : '' }}" data-bs-popper="static">
            <a class="dropdown-item {{ request()->routeIs('empleados') ? 'active' : '' }}" href="{{ route('empleados') }}">Empleados</a>
            <a class="dropdown-item {{ request()->routeIs('usuarios') ? 'active' : '' }}" href="{{ route('usuarios') }}">Usuarios</a>
        </div>
    </li>
</ul>
