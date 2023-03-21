@extends('layouts.app')

@section('template_title')
    Compra
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Compra') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('compras.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
										<th>Insumo Id</th>
										<th>Proveedora Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compras as $compra)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $compra->cantidad }}</td>
											<td>{{ $compra->referencia }}</td>
											<td>{{ $compra->estado }}</td>
											<td>{{ $compra->insumo_id }}</td>
											<td>{{ $compra->proveedora_id }}</td>

                                            <td>
                                                <form action="{{ route('compras.destroy',$compra->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('compras.show',$compra->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('compras.edit',$compra->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
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
@endsection
