<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar Clave</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center h-100 bg-dark" style="
        background: rgb(255,255,255);
        background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(84,57,148,1) 0%, rgba(28,125,203,1) 47%, rgba(93,175,166,1) 100%);">
        <div class="card p-3">
            <h3 class="text-center">Químicos del Zulia</h3>
            <h5 class="text-center">Recuperar Clave</h5>
            <form action="{{route('recuperar_email')}}" method="POST">
                @csrf
                @include('layouts.partials.messages')
                <label for="cedula">Cédula:</label>
                <input required class="form-control" type="text" name="cedula" id="cedula" placeholder="Cédula" required>

                <div class="d-flex justify-content-center w-100">
                    <a href="{{route('login')}}" class="btn btn-secondary">Regresar</a>
                    <input class="btn btn-primary" type="submit" value="Entrar">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
