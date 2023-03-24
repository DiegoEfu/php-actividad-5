<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTE</title>
    <style>
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center flex-column">
        <h1 class="text-center">REPORTE DE COMPRAS {{$tipo}}</h1>
        @if($compras->count())
        <table class="table table-striped table-hover">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Cantidad</th>
                    <th>Referencia</th>
                    <th>Insumo</th>
                    <th>Proveedora</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $compra->cantidad }}</td>
                        <td>{{ $compra->referencia }}</td>
                        <td>{{ $compra->insumo->nombre }}</td>
                        <td>{{ $compra->proveedora->razon_social }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-center">No hay compras abiertas.</p>
        @endif
    </div>
</body>
</html>
