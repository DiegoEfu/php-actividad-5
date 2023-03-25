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
        <h1 class="text-center">REPORTE DE STOCKS INSUMOS</h1>
        @if($insumos->count())
        <table width="100%" border="3" class="table table-striped table-hover">
            <thead class="thead">
                <tr>
                    <th>No</th>

                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                {{$total = 0}}
                @foreach ($insumos as $insumo)
                    <tr>
                        <td>{{ ++$i }}</td>

                        <td>{{ $insumo->nombre }}</td>
                        <td>{{ $insumo->precio }}</td>
                        <td style="text-align: right;">{{ $insumo->stock }}</td>
                    </tr>
                    {{$total += $insumo->stock}}
                @endforeach
            </tbody>
        </table>
        <table width="100%" border="3" class="table table-striped table-hover">
            <tbody>
                <tr class="totales">
                    <td>TOTAL DE INSUMOS EN INVENTARIO</td>
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
