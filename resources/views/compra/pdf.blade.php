<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<div class="d-flex justify-content-center flex-column">
    <h1 class="uppercase">REPORTE DE COMPRAS {{$tipo}}</h1>
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
