<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>
</head>
<body>
    <form action="{{route('login_post')}}" method="POST">
        @csrf
        @include('layouts.partials.messages')
        <input type="text" name="cedula" id="cedula" placeholder="cedula">
        <input type="text" name="password" id="password" placeholder="clave">
        <input type="submit" value="Entrar">
    </form>
</body>
</html>
