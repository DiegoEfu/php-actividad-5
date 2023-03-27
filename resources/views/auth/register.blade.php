<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center h-100 bg-dark" style="
        background: rgb(255,255,255);
        background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(84,57,148,1) 0%, rgba(28,125,203,1) 47%, rgba(93,175,166,1) 100%);">
        <div class="card p-3">
            <h3 class="text-center">Químicos del Zulia</h3>
            <h5 class="text-center">Crear Usuario</h5>
            <form action="{{route('register_post')}}" method="POST">
                @csrf
                @include('layouts.partials.messages')
                <label for="nombre">Nombre:</label>
                <input required class="form-control" placeholder="Nombre y Apellido" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚüÜ]+\s[A-Za-zñÑáéíóúÁÉÍÓÚüÜ]+" type="text" name="name">

                <label for="cedula">Cédula:</label>
                <input required class="form-control" placeholder="Cédula" type="text" name="cedula" pattern="[VE][0-9]+">

                <label for="email">Correo Electrónico:</label>
                <input required class="form-control" placeholder="Correo Electrónico" type="email" name="email">

                <label for="clave">Clave:</label>
                <input required class="form-control" placeholder="Clave" type="password" name="password">

                <label for="password_confirmation">Repetir Clave:</label>
                <input required class="form-control" placeholder="Repetir Clave" type="password" name="password_confirmation">

                <label for="password_confirmation">Rol de Usuario:</label>
                <select required class="form-select" name="cargo" id="cargo">
                    <option value="GESTOR DE COMPRAS">GESTOR DE COMPRAS</option>
                    <option value="ALMACENISTA">ALMACENISTA</option>
                </select>
                <div class="d-flex justify-content-center mt-1">
                    <a class="btn btn-secondary" href="{{route('login')}}">Regresar</a>
                    <input class="btn btn-primary" type="submit" value="Crear Usuario">
                </div>
            </form>

        </div>
    </div>
</body>
</html>
