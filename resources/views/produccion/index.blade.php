@extends('layouts.app')

@section('template_title')
    Produccion
@endsection

@section('content')
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
                                        <td>Fecha</td>

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
                {!! $produccions->links() !!}
            </div>
        </div>
    </div>
@endsection
