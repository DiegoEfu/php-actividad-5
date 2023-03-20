@extends('layouts.app')

@section('template_title')
    Proveedora
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Proveedora') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('proveedoras.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Identificacion</th>
										<th>Razon Social</th>
										<th>Telefono</th>
										<th>Correo Electronico</th>
										<th>Direccion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proveedoras as $proveedora)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $proveedora->identificacion }}</td>
											<td>{{ $proveedora->razon_social }}</td>
											<td>{{ $proveedora->telefono }}</td>
											<td>{{ $proveedora->correo_electronico }}</td>
											<td>{{ $proveedora->direccion }}</td>

                                            <td>
                                                <form action="{{ route('proveedoras.destroy',$proveedora->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('proveedoras.show',$proveedora->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('proveedoras.edit',$proveedora->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $proveedoras->links() !!}
            </div>
        </div>
    </div>
@endsection
