@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Insumos Producto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Insumos Producto</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('insumos_producto.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('insumos_producto.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
