<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    @auth
        <h1>¡Bienvenido, {{auth()->user()->name}} ({{auth()->user()->cedula}})!</h1>
        <a href="{{route('logout')}}">Cerrar Sesión</a>
    @endauth

    @guest
        <h1>Debes iniciar sesión para ver el contenido.</h1>
    @endguest
</body>
</html>
