@extends('layouts.app')

@section('template_title')
    {{ $insumosProducto->name ?? "{{ __('Show') Insumos Producto" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Insumos Producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('insumos-productos.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $insumosProducto->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Insumo Id:</strong>
                            {{ $insumosProducto->insumo_id }}
                        </div>
                        <div class="form-group">
                            <strong>Producto Id:</strong>
                            {{ $insumosProducto->producto_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
