<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            Producto:
            <select name="producto_id" id="producto_id" class="form-select">
                <option value="{{$producto['id']}}">{{$producto['nombre']}}</option>
            </select>
            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            Insumo:
            <select name="insumo_id" id="insumo_id" class="form-select">
                @foreach($insumos as $insumo)
                    <option value="{{$insumo['id']}}">{{$insumo['nombre']}}</option>
                @endforeach
            </select>
            {!! $errors->first('insumo_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad') }}:
            {{ Form::text('cantidad', $insumosProducto->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
