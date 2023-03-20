@extends('layouts.app')

@section('template_title')
    {{ $proveedora->name ?? "{{ __('Show') Proveedora" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Proveedora</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('proveedoras.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Identificacion:</strong>
                            {{ $proveedora->identificacion }}
                        </div>
                        <div class="form-group">
                            <strong>Razon Social:</strong>
                            {{ $proveedora->razon_social }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $proveedora->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Correo Electronico:</strong>
                            {{ $proveedora->correo_electronico }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $proveedora->direccion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
