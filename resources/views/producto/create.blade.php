@extends('layouts.app')

@section('template_title')
    Registrar Nuevo Producto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Producto</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('productos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                {{ Form::label('nombre') }}
                                {{ Form::text('nombre', $producto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('codigo_barra') }}
                                {{ Form::text('codigo_barra', $producto->codigo_barra, ['class' => 'form-control' . ($errors->has('codigo_barra') ? ' is-invalid' : ''), 'placeholder' => 'Codigo Barra']) }}
                                {!! $errors->first('codigo_barra', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <hr>
                            <div class="form-group">
                                Insumo:
                                <select class="form-select" name="insumo_id" id="cantidad">
                                    @foreach($insumos as $insumo)
                                        <option value="{{$insumo['id']}}">{{$insumo['nombre']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                Cantidad:
                                <input class="form-control" name="cantidad" type="number" min="0.01" step="0.01" placeholder="Cantidad">

                                <small>Si desea colocar más insumos para producir este producto, debe añadirlos en el detalle.</small>
                            </div>
                            <div class="box-footer mt20">
                                <a class="btn btn-secondary" href="{{route('productos.index')}}">Regresar</a>
                                <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
