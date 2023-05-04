<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="{{asset('css/tabler.min.css')}}">
</head>
<body class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <!-- <div class="text-center mb-4">
                <a href="#" class="navbar-brand navbar-brand-autodark">
                    <img src="" height="36" alt="">
                </a>
            </div> -->
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Ingrese a su cuenta</h2>

                    <form action="{{route('login')}}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="clave">Clave</label>
                            <input type="text" id="clave" name="clave" class="form-control @error('clave') is-invalid @enderror" value="{{ old('clave') }}" autofocus required>
                            @error('clave')

                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="password">
                                Contraseña
                                <span class="form-label-description">
                                    <a href="#">Olvidé mi contraseña</a>
                                </span>
                            </label>

                            <div class="row g-2">
                                <div class="col">
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" required>
                                    @error('password')

                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-auto">
                                    <button type="button" class="btn btn-icon" onclick="showPassword()" title="Mostrar" data-bs-toggle="tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <circle cx="12" cy="12" r="2" />
                                            <path
                                                d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" />
                                <span class="form-check-label">Recordarme</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center text-muted mt-3">
                ¿Aún no tienes una cuenta? <a href="{{route('register')}}" tabindex="-1">Regístrate</a>
            </div>
        </div>
    </div>

    <script src="{{asset('js/tabler.min.js')}}" defer></script>
    <script>
        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>
