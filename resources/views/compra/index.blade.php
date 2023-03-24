@extends('layouts.app')

@section('template_title')
    Compra
@endsection

@section('content')
    <canvas class="m-3" id="grafica" style="max-height: 40vh; min-height: 40vh;"></canvas>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Compras') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('compras.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Registrar Nueva') }}
                                </a>
                                <a href="{{ route('compras.pdf_abiertas') }}" class="btn btn-success btn-sm float-right"  data-placement="left">
                                    {{ __('PDF Compras Abiertas') }}
                                </a>
                                <a href="{{ route('compras.pdf_cerradas') }}" class="btn btn-danger btn-sm float-right"  data-placement="left">
                                    {{ __('PDF Compras Cerradas') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

										<th>Cantidad</th>
										<th>Referencia</th>
										<th>Estado</th>
										<th>Insumo</th>
										<th>Proveedora</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compras as $compra)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $compra->cantidad }}</td>
											<td>{{ $compra->referencia }}</td>
											<td>@if($compra['estado'] == 'A') Abierta @else Cerrada @endif</td>
											<td>{{ $compra->insumo->nombre }}</td>
											<td>{{ $compra->proveedora->razon_social }}</td>

                                            <td>
                                                <form action="{{ route('compras.destroy',$compra->id) }}" method="POST">
                                                    @if($compra->estado == 'A') <a class="btn btn-sm btn-primary " href="{{ route('compras.show',$compra->id) }}"><i class="fa fa-window-close"></i> {{ __('Cerrar') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('compras.edit',$compra->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @endif
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $compras->links() !!}
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script>
        $(document).ready(() => {
            let canvas = document.getElementById('grafica').getContext('2d');
            let datosGrafica = JSON.parse(`{{$data}}`.replaceAll('&quot;', '"'));
            console.log(datosGrafica);

            let datosInterpretados = {};

            datosGrafica.forEach(element => {
                datosInterpretados[element.nombre] = element.cantidad;
            });

            chart = new Chart(canvas, {
                type: 'bar',
                data: {
                    datasets: [
                        {
                            data: Object.values(datosInterpretados),
                            backgroundColor: ['#00F',],
                            indexAxis: 'y',
                        }
                    ],
                    labels: Object.keys(datosInterpretados)
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Productos Más Producidos',
                            position: 'top'
                        },
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
@endsection
