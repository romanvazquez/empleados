<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registrarme</title>
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
                    <h2 class="h2 text-center mb-4">Crea una nueva cuenta</h2>
                    <form action="{{route('register')}}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="clave">Clave</label>
                            <input type="text" id="clave" name="clave" class="form-control @error('clave') is-invalid @enderror" value="{{ old('clave') }}" required>
                            @error('clave')

                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" required>
                            @error('password')

                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="password_confirmation">Confirmación de la contraseña</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')

                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Registrarme</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center text-muted mt-3">
                ¿Ya tienes una cuenta? <a href="{{route('login')}}" tabindex="-1">Iniciar sesión</a>
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
