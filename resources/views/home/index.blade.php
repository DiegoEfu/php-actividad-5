@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center h-75" style="">
    <div class="card w-75 h-75 p-2">
        <h3 class="text-center">Sistema de Inventario de Químicos del Zulia CA</h3>
        <div class="row">
            <div class="col-6"><p><b>Usuario:</b> {{auth()->user()->name}}</p>
                <p><b>Cédula:</b> {{auth()->user()->cedula}}</p>
                <p><b>Cargo:</b> {{auth()->user()->cargo}}</p></div>
            <div class="col-6">
                @if(auth()->user()->cargo == 'ALMACENISTA')
                    <a class="btn mt-1 btn-primary w-100" href="{{route('insumos.index')}}">Insumos</a>
                    <a class="btn mt-1 btn-warning w-100" href="{{route('produccions.index')}}">Producción</a>
                    <a class="btn mt-1 btn-success w-100" href="{{route('productos.index')}}">Productos</a>
                @else
                    @if(auth()->user()->cargo == 'GESTOR DE COMPRAS')
                        <a class="btn mt-1 btn-secondary w-100" href="{{route('compras.index')}}">Compras</a>
                        <a class="btn mt-1 btn-info w-100" href="{{route('proveedoras.index')}}">Proveedoras</a>
                    @endif

                    @if(auth()->user()->cargo == 'ADMIN')
                        <a class="btn mt-1 btn-primary w-100" href="{{route('insumos.index')}}">Insumos</a>
                        <a class="btn mt-1 btn-secondary w-100" href="{{route('compras.index')}}">Compras</a>
                        <a class="btn mt-1 btn-success w-100" href="{{route('productos.index')}}">Productos</a>
                        <a class="btn mt-1 btn-warning w-100" href="{{route('produccions.index')}}">Producción</a>
                        <a class="btn mt-1 btn-info w-100" href="{{route('proveedoras.index')}}">Proveedoras</a>
                    @endif
                @endif
                <a class="btn mt-1 btn-danger w-100" href="{{route('logout')}}">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</div>
@endsection
