@extends('layouts.app')

@section('template_title')
    Produccion
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
                                {{ __('Produccion') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('produccions.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Registrar Nueva') }}
                                </a>
                                <a target="_blank" href="{{ route('produccions.pdf') }}" class="btn btn-success btn-sm float-right"  data-placement="left">
                                    {{ __('PDF de Producciones') }}
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
										<th>Producto</th>
                                        <th>Fecha</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produccions as $produccion)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $produccion->cantidad }}</td>
											<td>{{ $produccion->producto->nombre }}</td>
                                            <td>{{ $produccion->created_at }}</td>

                                            <td>
                                                <form action="{{ route('produccions.destroy',$produccion->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('produccions.edit',$produccion->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @if(Auth::check() && Auth::user()->cargo == 'ADMIN')
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $produccions->links() !!}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
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
