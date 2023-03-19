<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
</head>
<body>
    <form action="{{route('register_post')}}" method="POST">
        @csrf
        @include('layouts.partials.messages')
        <input type="text" name="name">
        <input type="text" name="cedula" pattern="[VE][0-9]+">
        <input type="email" name="email">
        <input type="password" name="password">
        <input type="password" name="password_confirmation">
        <select name="cargo" id="cargo">
            <option value="ADMIN">ADMINISTRADOR</option>
        </select>
        <input type="submit">
    </form>
</body>
</html>
