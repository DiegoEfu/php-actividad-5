@extends('layouts.app')

@section('template_title')
    {{ $compra->name ?? "{{ __('Show') Compra" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Compra</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('compras.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $compra->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Referencia:</strong>
                            {{ $compra->referencia }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $compra->estado }}
                        </div>
                        <div class="form-group">
                            <strong>Insumo Id:</strong>
                            {{ $compra->insumo_id }}
                        </div>
                        <div class="form-group">
                            <strong>Proveedora Id:</strong>
                            {{ $compra->proveedora_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
