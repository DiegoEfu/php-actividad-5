<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center h-100 bg-dark" style="
        background: rgb(255,255,255);
        background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(84,57,148,1) 0%, rgba(28,125,203,1) 47%, rgba(93,175,166,1) 100%);">
        <div class="card p-3">
            <h3 class="text-center">Químicos del Zulia</h3>
            <h5 class="text-center">Sistema de Inventario</h5>
            <form action="{{route('login_post')}}" method="POST">
                @csrf
                @include('layouts.partials.messages')
                <label for="cedula">Cédula:</label>
                <input class="form-control" type="text" name="cedula" id="cedula" placeholder="Cédula"> <br>

                <label for="cedula">Clave:</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Clave"> <br>

                <div class="d-flex justify-content-center w-100">
                    <input class="btn btn-primary" type="submit" value="Entrar">
                </div>
            </form>
            <div class="d-flex justify-content-between w-100">
                <a href="{{route('register')}}"><small>Registrarse</small></a>
                <a href="{{route('register')}}"><small>Recuperar Clave</small></a>
            </div>
        </div>
    </div>
</body>
</html>
