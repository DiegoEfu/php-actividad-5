<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            Producto:
            <select class="form-control" name="producto_id" id="producto_id">
                @foreach($productos as $producto)
                    @if($produccion->producto_id == $producto->id)
                        <option value="{{$producto->id}}" selected>{{$producto->nombre}}</option>
                    @else
                        <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                    @endif
                @endforeach
            </select>
            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $produccion->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20 d-flex justify-content-center">
        <a class="btn btn-secondary" href="{{route('produccions.index')}}">Regresar</a>
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
