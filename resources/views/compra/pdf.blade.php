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

        .thead, .totales{
            background: #000;
            color: white;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center flex-column">
        <h1 class="text-center">REPORTE DE COMPRAS {{$tipo}}</h1>
        <b>Generado el: {{Carbon\Carbon::now()->toDateTimeString()}}. Por el usuario: {{Auth::user()->name}}</b>
        @if($compras->count())
        <table width="100%" border="3" class="table table-striped table-hover">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Cantidad</th>
                    <th>Referencia</th>
                    <th>Insumo</th>
                    <th>Proveedora</th>
                    <th>Costo</th>
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
                        <td style="text-align: right;">{{($compra->cantidad)*($compra->insumo->precio)}}</td>
                    </tr>
                    {{$total += $compra->cantidad*($compra->insumo->precio)}}
                @endforeach
            </tbody>
        </table>
        <table border="3" width="100%">
            <tbody>
                <tr class="totales">
                    <td width="80%">TOTAL</td>
                    <td width="20%" style="text-align: right;">{{$total}}</td>
                </tr>
            </tbody>
        </table>
        @else
        <p class="text-center">No hay compras abiertas.</p>
        @endif
    </div>
</body>
</html>
