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
        <h3 class="text-center">Químicos del Zulia</h3>
        <h1 class="text-center">REPORTE DE STOCKS PRODUCTOS</h1>
        @if($productos->count())
        <table width="100%" border="3" class="table table-striped table-hover">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Nombre</th>
                    <th>Codigo Barra</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                {{$total = 0}}
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->codigo_barra }}</td>
                        <td style="text-align: right;">{{ $producto->stock }}</td>
                    </tr>
                    {{$total += $producto->stock}}
                @endforeach
            </tbody>
        </table>
        <table width="100%" border="3" class="table table-striped table-hover">
            <tbody>
                <tr class="totales">
                    <td>TOTAL DE PRODUCTOS EN INVENTARIO</td>
					<td style="text-align: right;">{{ $total }}</td>
                </tr>
            </tbody>
        </table>
        @else
        <p class="text-center">No hay productos en el catálogo.</p>
        @endif
        <br>
        Generado el: <b>{{Carbon\Carbon::now()->toDateTimeString()}}</b>. <br>
        Por el usuario: <b>{{Auth::user()->name}}</b>.
    </div>
</body>
</html>
